<?php

namespace Harrysbaraini\JasonApi;

class ResourceIdentifier implements \JsonSerializable
{
    /**
     * @var string
     */
    private string $type;

    /**
     * @var string
     */
    private string $id;

    public function __construct(string $type, string $id)
    {
        $this->type = $type;
        $this->id = $id;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'type' => $this->type,
            'id'   => $this->id,
        ];
    }
}
