<?php
namespace App\Exceptions;

use Throwable;

/**
 * Class ForbiddenException
 * @package App\Exceptions
 */
class ForbiddenException extends \Exception{

    public function __construct(string $message = "", int $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
