<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    protected $authUser;

    protected function setUp(): void
    {
        parent::setUp();

        // كتابة الصلاحيات (العمليات)
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

        // (role)كتابة الصلاحيات
        $roles = [
            'مدير النظام',
            'مدير المحتوى',
            'محاضر',
            'مستخدم'
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // إنشاء دور وأذونات
        $role = Role::first(); // استخدام أول دور تم إنشاؤه
        $permission = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permission);

        // إنشاء مستخدم واحد وتعيين الأدوار
        $this->authUser = User::create([
            'name' => 'auth_user',
            'email' => 'auth_user@example.com',
            'password' => bcrypt('password123'),
            'phone' => '774370569',
            'status' => true,
        ]);
        $this->authUser->assignRole($role);

        // تسجيل الدخول كمستخدم
        $this->actingAs($this->authUser);
    }

    public function testIndex()
    {
        $response = $this->get('/control/roles');

        $response->assertStatus(200);
        $response->assertViewHas('roles');
    }

    public function testCreate()
    {
        $response = $this->get('/control/roles/create');

        $response->assertStatus(200);
        $response->assertViewHas('permission');
    }

    public function testStore()
    {
        $roleData = [
            'name' => 'Test Role',
            'permission' => Permission::all()->pluck('id')->toArray(),
        ];

        $response = $this->post('/control/roles/store', $roleData);

        $response->assertRedirect('/control/roles');
        $this->assertDatabaseHas('roles', ['name' => 'Test Role']);
    }

    public function testShow()
    {
        $role = Role::first();
        $response = $this->get("/control/roles/{$role->id}/show");

        $response->assertStatus(200);
        $response->assertViewHas('role');
        $response->assertViewHas('rolePermissions');
    }

    public function testEdit()
    {
        $role = Role::first();
        $response = $this->get("/control/roles/{$role->id}/edit");

        $response->assertStatus(200);
        $response->assertViewHas('role');
        $response->assertViewHas('permission');
        $response->assertViewHas('rolePermissions');
    }

    public function testUpdate()
    {
        $role = Role::first();
        $roleData = [
            'name' => 'Updated Role',
            'permission' => Permission::all()->pluck('id')->toArray(),
        ];

        $response = $this->put("/control/roles/{$role->id}/update", $roleData);

        $response->assertRedirect('/control/roles');
        $this->assertDatabaseHas('roles', ['name' => 'Updated Role']);
    }

    public function testDestroy()
    {
        $role = Role::first();

        $response = $this->delete("/control/roles/{$role->id}/delete");

        $response->assertRedirect('/control/roles');
        $this->assertDatabaseMissing('roles', ['id' => $role->id]);
    }
}
