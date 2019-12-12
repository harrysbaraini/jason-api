<?php

namespace Harrysbaraini\JasonApi;

use Harrysbaraini\JasonApi\Contracts\ResourceObject as ResourceObjectContract;

class DataDocument implements \JsonSerializable, ResourceObjectContract
{
    /**
     * @var Resource
     */
    private Resource $resourceObject;

    /**
     * @var MetaDocument|null
     */
    private ?MetaDocument $meta;

    public function __construct(ResourceObjectContract $resourceObject)
    {
        $this->resourceObject = $resourceObject;
    }

    public function meta(MetaDocument $document)
    {
        $this->meta = $document;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        $data = [
            'data' => $this->resourceObject,
        ];

        if (isset($this->meta)) {
            $data['meta'] = $this->meta;
        }

        return $data;
    }
}
