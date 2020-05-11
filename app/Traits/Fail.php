<?php
namespace App\Traits;

trait Fail {
    protected function fail($message, $code, $extend = []) {
        return array_merge(
            [
                'code' => $code,
                'message' => $message
            ],
            $extend
        );
    }
}
