<?php
namespace App\Exceptions;

use Throwable;

class ForbiddenException extends \Exception{

    public function __construct(string $message = "", int $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render($request){
        if($request->expectsJson()) {
            return response()->json([
                'errorCode' => $this->getCode()
            ], 200);
        }
    }
}