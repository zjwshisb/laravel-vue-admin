<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\Models\Admin();
        $admin->username = 'admin';
        $admin->password = 'admin';
        $admin->is_super = 1;
        $admin->save();
        $this->call([
            PermissionSeeder::class
        ]);
    }
}
