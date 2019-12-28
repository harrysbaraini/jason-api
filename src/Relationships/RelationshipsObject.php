<?php

namespace Harrysbaraini\JasonApi\Relationships;

class RelationshipsObject implements \JsonSerializable
{
    /** @var array */
    private array $items;

    public function __construct(Relationship ...$items)
    {
        $this->items = $items;
    }

    /**
     * Add one or more relationships to the object.
     *
     * @param Relationship ...$items
     * @return $this
     */
    public function add(Relationship ...$items): self
    {
        foreach ($items as $item) {
            $this->items[] = $item;
        }

        return $this;
    }

    /**
     * Remove all relationships.
     *
     * @return $this
     */
    public function flush(): self
    {
        $this->items = [];
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        $relationships = [];

        foreach ($this->items as $item) {
            $relationships[] = $item->jsonSerialize();
        }

        return array_merge(...$relationships);
    }
}
