<?php

namespace Harrysbaraini\JasonApi;

use Harrysbaraini\JasonApi\Contracts\Resource as ResourceContract;
use Harrysbaraini\JasonApi\Links\LinksObject;
use Harrysbaraini\JasonApi\Relationships\RelationshipsObject;

final class Resource implements ResourceContract
{
    /** @var ResourceIdentifier */
    private ResourceIdentifier $identifier;

    /** @var Attribute[] */
    private array $attributes;

    /** @var LinksObject|null */
    private ?LinksObject $links = null;

    /** @var RelationshipsObject|null */
    private ?RelationshipsObject $relationships = null;

    /**
     * Resource constructor.
     *
     * @param string $type
     * @param string $id
     */
    public function __construct(string $type, string $id)
    {
        $this->identifier = new ResourceIdentifier($type, $id);
    }

    /**
     * Add one or more attributes to the resource.
     *
     * @param Attribute[] $attributes
     * @return $this
     */
    public function attributes(Attribute ...$attributes): self
    {
        foreach ($attributes as $attr) {
            $this->attributes[] = $attr;
        }

        return $this;
    }

    /**
     * Set the links object.
     *
     * @param LinksObject $links
     * @return $this
     */
    public function links(LinksObject $links): self
    {
        $this->links = $links;
        return $this;
    }

    public function relationships($relationships): self
    {
        $this->relationships = $relationships;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        $data = array_merge($this->identifier->jsonSerialize(), [
            'attributes' => $this->buildAttributes(),
        ]);

        if (isset($this->links)) {
            $data['links'] = $this->links;
        }

        if (isset($this->relationships)) {
            $data['relationships'] = $this->relationships;
        }

        return $data;
    }

    /**
     * Build a relational array from the resource attributes.
     *
     * @return array
     */
    protected function buildAttributes(): array
    {
        $attributes = [];

        foreach ($this->attributes as $attr) {
            $attributes[$attr->name()] = $attr->value();
        }

        return $attributes;
    }
}
