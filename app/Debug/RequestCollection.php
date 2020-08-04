<?php
namespace App\Debug;

use Illuminate\Support\Facades\Route;
use Lanin\Laravel\ApiDebugger\Collection;

class RequestCollection implements Collection {
    /**
     * Collection name.
     *
     * @return string
     */
    public function name(){
        return 'request';
    }

    /**
     * Returns resulting collection.
     *
     * @return array
     */
    public function items(){
        return [
            'name'=> Route::current()->getName() ?? '',
            'controller'=> Route::current()->getActionName(),
            'data'=> request()->all(),
            'method'=> request()->getMethod()
        ];
    }
}
