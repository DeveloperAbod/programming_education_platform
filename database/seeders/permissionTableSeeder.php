<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'عرض المستخدمين',
            'اضافة مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',
            'عرض الصلاحيات',
            'اضافة صلاحية',
            'تعديل صلاحية',
            'حذف صلاحية',


            'عرض الكورسات',
            'اضافة كورس',
            'تعديل كورس',
            'تعديل كورس خاص بي',
            'حذف كورس',
            'قبول كورس',
            'ايقاف وتفعيل كورس',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

// php artisan db:seed --class=PermissionTableSeeder