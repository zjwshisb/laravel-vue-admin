<?php
namespace App\Traits;

trait ResponseFormat {

    public function fail($msg = '', $code = -1) {
        return [
            'err_msg'=> $msg,
            'code'=> $code
        ];
    }
}

