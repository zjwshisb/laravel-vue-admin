<?php
namespace App\Http\Controllers\Backend;

use App\Http\Resources\AdminActionLogResource;
use App\Models\AdminActionLog;
use Illuminate\Http\Request;

class AdminActionLogController extends BaseController{

    public function index(Request $request) {
        $logs = AdminActionLog::filter($request->all())->with('admin')->orderBy('id','desc')->paginate($request->size);
        return AdminActionLogResource::collection($logs);
    }
}
