<?php
namespace App\Http\Controllers\Backend;


use App\Models\AdminActionLog;

/**
 * Class SystemDashboardController
 * @package App\Http\Requests\Backen
 */
class SystemDashboardController extends BaseController{

    public function index() {
        $activities = AdminActionLog::query()->with('admin')->latest('id')->limit(5)->get();
        return [
          'activities' => $activities->map(function($log) {
            return [
                'id' => $log->id,
                'name'=> $log->name,
                'admin_name'=> $log->admin->username ?? '',
                'created_at'=> $log->created_at
            ];
          })
        ];
    }
}
