<?php

namespace Harrysbaraini\JasonApi;

use Harrysbaraini\JasonApi\Contracts\Resource as ResourceObjectContract;

class DataDocument implements ResourceObjectContract
{
    /**
     * @var ResourceObjectContract
     */
    private ResourceObjectContract $resourceObject;

    /**
     * @var MetaObject|null
     */
    private ?MetaObject $meta;

    public function __construct(ResourceObjectContract $resourceObject)
    {
        $this->resourceObject = $resourceObject;
    }

    public function meta(MetaObject $meta)
    {
        $this->meta = $meta;
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
