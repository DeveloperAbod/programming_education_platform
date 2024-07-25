<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'مدير النظام',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'phone' => '774370569',
            'roles_name' => ["مدير النظام"],
            'status' => "1",
        ]);
        $role = Role::create(['name' => 'مدير النظام']);
        $permission = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permission);
        $user->assignRole([$role->id]);
    }
}

// php artisan db:seed --class=CreateAdminUserSeeder