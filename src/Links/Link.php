<?php

namespace Harrysbaraini\JasonApi\Links;

use JsonSerializable;

class Link implements JsonSerializable
{
    /** @var string */
    private string $name;

    /** @var string */
    private string $value;

    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            $this->name => $this->value,
        ];
    }
}
