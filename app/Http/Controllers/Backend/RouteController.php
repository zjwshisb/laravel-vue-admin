<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Route;

class RouteController extends BaseController {
    public function index() {
        return array_map(function($route){
//            return $route;
          return array_merge($route->action, [
              'uri'=> $route->uri,
              'methods'=> $route->methods
          ]);
        },Route::getRoutes()->getRoutes());
    }
}
