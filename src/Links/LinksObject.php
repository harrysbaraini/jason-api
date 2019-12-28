<?php

namespace Harrysbaraini\JasonApi\Links;

use JsonSerializable;

class LinksObject implements JsonSerializable
{
    /** @var Link[] */
    private array $items;

    /**
     * LinksObject constructor.
     *
     * @param Link ...$items
     */
    public function __construct(Link ...$items)
    {
        $this->items = $items;
    }

    /**
     * A a list of links to the object.
     *
     * @param Link ...$items
     * @return $this
     */
    public function add(Link ...$items): self
    {
        foreach ($items as $item) {
            $this->items[] = $item;
        }

        return $this;
    }

    /**
     * Remove all links.
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
        $links = [];

        foreach ($this->items as $item) {
            $links[] = $item->jsonSerialize();
        }

        return array_merge(...$links);
    }
}
