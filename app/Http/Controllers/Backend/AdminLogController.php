<?php

namespace App\Http\Controllers\Backend;

use App\Http\Resources\Backend\AdminLogResource;
use App\Models\AdminActionLog;
use Illuminate\Http\Request;

class AdminLogController extends BackendController
{
    public function index(Request $request)
    {
        $query = AdminActionLog::when($request->name, function ($query) use ($request) {
            return $query->whereHas('admin', function ($query) use ($request) {
                $query->whereLike('name', $request->name);
            });
        });
        return AdminLogResource::collection($query->paginate($request->size));
    }
}
