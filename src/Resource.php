<?php

namespace Harrysbaraini\JasonApi;

use Harrysbaraini\JasonApi\Contracts\ResourceObject;

final class Resource implements ResourceObject, \JsonSerializable
{
    /** @var ResourceIdentifier */
    private ResourceIdentifier $identifier;

    /** @var Attribute[] */
    private array $attributes;

    public function __construct(string $type, string $id)
    {
        $this->identifier = new ResourceIdentifier($type, $id);
    }

    public function attribute(Attribute $attribute): self
    {
        $this->attributes[] = $attribute;
        return $this;
    }

    public function attributes(Attribute ...$attributes): self
    {
        foreach ($attributes as $attr) {
            $this->attributes[] = $attr;
        }

        return $this;
    }

    public function replaceAttributes(Attribute ...$attributes): self
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function flushAttributes(): self
    {
        $this->attributes = [];
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return array_merge($this->identifier->jsonSerialize(), [
            'attributes' => $this->buildAttributes(),
        ]);
    }

    protected function buildAttributes(): array
    {
        $attributes = [];

        foreach ($this->attributes as $attr) {
            $attributes[$attr->name()] = $attr->value();
        }

        return $attributes;
    }
}
