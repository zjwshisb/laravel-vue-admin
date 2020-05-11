<?php
namespace App\Http\Controllers\Backend;

class MeController extends BaseController{
    public function index() {
        return $this->success([
           'id'=> \Auth::id(),
           'username'=> \Auth::user()->username
        ]);
    }
}
