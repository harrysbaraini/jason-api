<?php

namespace Harrysbaraini\JasonApi\Relationships;

use Harrysbaraini\JasonApi\Links\LinksObject;
use Harrysbaraini\JasonApi\ResourceIdentifier;
use JsonSerializable;

class Relationship implements JsonSerializable
{
    /**
     * @var ResourceIdentifier
     */
    private ResourceIdentifier $resourceIdentifier;

    /** @var LinksObject|null */
    private ?LinksObject $links = null;

    /**
     * @var string
     */
    private string $name;

    public function __construct(string $name, ResourceIdentifier $resourceIdentifier)
    {
        $this->name = $name;
        $this->resourceIdentifier = $resourceIdentifier;
    }

    public function links(LinksObject $links): self
    {
        $this->links = $links;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        $data = [
            'data' => $this->resourceIdentifier,
        ];

        if (isset($this->links)) {
            $data['links'] = $this->links;
        }

        return [$this->name => $data];
    }
}
