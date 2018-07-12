<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

/**
 * Class BackendController
 * @package App\Http\Controller\Backend
 */
class BackendController extends Controller{

    /**
     * @param $data
     * @param string $key
     * @return array
     */
    protected function success($data,string $key = 'data') : array {
        if(!is_array($data)){
            $data =  [ $key => $data];
        }
        $data['status'] = config('status.success');
        return $data;
    }

    /**
     * @param null $msg
     * @return array
     */
    protected function fail($msg = null) : array {
        $data['status'] = config('status.fail');
        if(!is_null($msg)){
            $data['msg'] = $msg;
        }
        return $data;
    }

}