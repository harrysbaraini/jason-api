<?php

namespace Harrysbaraini\JasonApi\Laravel;

use Harrysbaraini\JasonApi\Attribute;
use Harrysbaraini\JasonApi\Resource as ResourceObject;
use Harrysbaraini\JasonApi\ResourceIdentifier;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use ReflectionException;

class Resource implements Arrayable
{
    /** @var string|null */
    protected ?string $name;

    /** @var ResourceObject */
    protected ResourceObject $resource;

    /**
     * Resource constructor.
     *
     * @param            $id
     * @param array|null $attributes
     * @throws ReflectionException
     */
    public function __construct($id, ?array $attributes = null)
    {
        $this->resource = $this->buildResourceObject($id, $attributes);
    }

    /**
     * Get the resource name.
     *
     * @return string
     * @throws ReflectionException
     */
    public function getName(): string
    {
        if (isset($this->name)) {
            return $this->name;
        }

        $name = (new \ReflectionClass($this))->getShortName();

        return Str::plural(Str::slug($name));
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return $this->resource->jsonSerialize();
    }

    /**
     * Build the base resource object or resource identifier.
     *
     * @param            $id
     * @param array|null $attributes
     * @return ResourceObject|ResourceIdentifier
     * @throws ReflectionException
     */
    protected function buildResourceObject($id, ?array $attributes = null)
    {
        if (isset($attributes)) {
            $resource = new ResourceObject($this->getName(), $id);

            $resource->attributes(
                ...Collection::make($attributes)->map(fn($value, $key) => new Attribute($key, $value))->toArray()
            );

            return $resource;
        }

        return new ResourceIdentifier($this->getName(), $id);
    }
}
