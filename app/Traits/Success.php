<?php
namespace App\Traits;

trait Success {

    protected function success($data = [], $extend = []) : array {
        return array_merge([
            'code'=> 0,
            'data'=> $data
        ], $extend);
    }
}
