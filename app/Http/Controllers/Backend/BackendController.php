<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

/**
 * Class BackendController
 * @package App\Http\Controller\Backend
 */
class BackendController extends Controller{
    public function failed($msg = '') {
        return [
            'msg'=> $msg,
            'result'=> false
        ];
    }
}
