<?php

namespace Harrysbaraini\JasonApi\Exceptions;

use Exception;

class InvalidJsonObject extends Exception
{
    protected $message = 'Invalid JSON object';
}
