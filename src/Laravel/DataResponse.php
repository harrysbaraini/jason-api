<?php

namespace Harrysbaraini\JasonApi\Laravel;

use Harrysbaraini\JasonApi\Contracts\Resource as ResourceContract;
use Harrysbaraini\JasonApi\DataDocument;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Responsable;

class DataResponse implements Responsable, Arrayable
{
    /** @var DataDocument */
    private DataDocument $dataDocument;

    /** @var int */
    private int $statusCode = 200;

    /**
     * DataResponse constructor.
     *
     * @param ResourceContract $resource
     */
    public function __construct(ResourceContract $resource)
    {
        $this->dataDocument = new DataDocument($resource);
    }

    /**
     * @param int $statusCode
     * @return $this
     */
    public function withStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }


    /**
     * @inheritDoc
     */
    public function toResponse($request)
    {
        return response()->json($this->toArray(), $this->statusCode);
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return $this->dataDocument->jsonSerialize();
    }
}
