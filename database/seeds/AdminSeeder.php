<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(!Admin::query()->where('username', 'admin')->exists()) {
            $admin = new Admin();
            $admin->username = 'admin';
            $admin->password = 'admin';
            $admin->is_super = 1;
            $admin->save();
        }
    }
}
