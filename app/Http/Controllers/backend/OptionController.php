<?php
namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;

class OptionController extends BaseController{

    public function index(Request $request) {
        $sources = $request->get('sources', []);
        $data = [];
        foreach ($sources as $key) {
            if (method_exists($this, $key)) {
                $data[$key] = $this->$key($request);
            }
        }
        return $data;
    }

    public function admin_menus() {

    }
}
