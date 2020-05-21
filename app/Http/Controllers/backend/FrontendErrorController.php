<?php
namespace App\Http\Controllers\Backend;

use App\Http\Resources\FrontendErrorResource;
use App\Models\FrontendError;
use Illuminate\Http\Request;

class FrontendErrorController extends BaseController {

    public function index(Request $request) {
        $list = FrontendError::query()->orderBy('id','desc')->paginate($request->size);
        return FrontendErrorResource::collection($list);
    }


    public function store(Request $request) {
        FrontendError::query()->create(array_merge($request->all(), [
            'admin_id'=> \Auth::guard('admin')->id(),
            'created_at' => now()->toDateTimeString()
        ]));
    }

    public function flush() {
        FrontendError::query()->delete();
        return $this->success();
    }
}
