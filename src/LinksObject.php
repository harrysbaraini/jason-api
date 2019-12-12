<?php

namespace Harrysbaraini\JasonApi;

use JsonSerializable;

class LinksObject implements JsonSerializable
{
    /** @var Link[] */
    private array $links;

    public function __construct(Link ...$links)
    {
        $this->links = $links;
    }

    public function link(Link $link): self
    {
        $this->links[] = $link;
        return $this;
    }

    public function links(Link ...$links): self
    {
        foreach ($links as $link) {
            $this->links[] = $link;
        }

        return $this;
    }

    public function replaceLinks(Link ...$links): self
    {
        $this->links = $links;
        return $this;
    }

    public function flushLinks(): self
    {
        $this->links = [];
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        $links = [];

        foreach ($this->links as $link) {
            $links[] = $link->jsonSerialize();
        }

        return array_merge(...$links);
    }
}
