<?php

namespace Harrysbaraini\JasonApi;

class MetaObject implements \JsonSerializable
{
    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [];
    }
}
