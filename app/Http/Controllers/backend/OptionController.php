<?php
namespace App\Http\Controllers\Backend;


use App\Models\AdminMenu;
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
        return AdminMenu::query()->whereNull('parent_id')
            ->select(['id','name','parent_id', 'has_permission'])
            ->with('children.children.children')->get();
    }
}
