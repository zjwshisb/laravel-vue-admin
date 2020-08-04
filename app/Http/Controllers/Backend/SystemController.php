<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Redis;

class SystemController extends BaseController{

    public function redis() {
        try {
            $info =  Redis::info('all');
            $format = [];
            foreach ($info as $label => $val) {
                $format[] = [
                    'value'=> $val,
                    'key'=> $label
                ];
            }
            return $this->success([
                'info'=> $format,
                'client'=> config('database.redis.client')
            ]);
        }catch (\Exception $exception) {
            return $this->fail($exception->getMessage(), 500);
        }

    }
}
