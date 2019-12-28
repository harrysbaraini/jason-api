<?php

namespace Harrysbaraini\JasonApi;

use Harrysbaraini\JasonApi\Contracts\Resource as ResourceContract;

class ResourceCollection implements ResourceContract
{
    /** @var array|ResourceContract[]|null[] */
    protected array $resources = [];

    /**
     * ResourceCollection constructor.
     *
     * @param ResourceContract|null ...$resources
     */
    public function __construct(?ResourceContract ...$resources)
    {
        if (isset($resources)) {
            $this->resources = $resources;
        }
    }

    /**
     * Add resources to the collection.
     *
     * @param ResourceContract ...$resources
     * @return $this
     */
    public function add(ResourceContract ...$resources): self
    {
        foreach ($resources as $resource) {
            $this->resources[] = $resource;
        }

        return $this;
    }

    /**
     * Remove all resource children.
     *
     * @return $this
     */
    public function flush(): self
    {
        $this->resources = [];
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->resources;
    }
}
