<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    use RefreshDatabase;
    protected $authUser;

    // this  will work for every test function
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

    public function testIndexUsers()
    {
        // تنفيذ الطلب
        $response = $this->get('/control/users');

        // التحقق من العرض
        $response->assertStatus(200);
        $response->assertViewHas('users');
    }


    public function testShowUser()
    {
        //تنفيذ الطلب
        $auth_user = User::factory()->create();

        $response = $this->get("/control/users/{$auth_user->id}/show");

        // التحقق من العرض
        $response->assertStatus(200);
        $response->assertViewHas('user', $auth_user);
    }

    public function testCreateUser()
    {
        //  استخدمناه للمقارنة مع قاعدة البيانات للتحقق من سلامة البيانات
        $roles = [
            'مدير النظام',
            'مدير المحتوى',
            'محاضر',
            'مستخدم',
            'مستخدم'
        ];

        // Execute the request
        $response = $this->get('/control/users/create');

        // Verify the response
        $response->assertStatus(200);
        $response->assertViewHas('roles', function ($viewRoles) use ($roles) {
            return collect($roles)->every(function ($role) use ($viewRoles) {
                return array_key_exists($role, $viewRoles);
            });
        });
    }


    public function testStoreNewUser()
    {
        // إنشاء أدوار وأذونات
        $role = Role::first(); // استخدام أول دور تم إنشاؤه
        $permission = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permission);

        // بيانات المستخدم المزيفة
        $userData = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'confirm-password' => 'password123',
            'roles_name' => [$role->name],
            'phone' => '712345678',
            'status' => true,
        ];

        // تنفيذ طلب لإنشاء المستخدم
        $response = $this->post('/control/users/store', $userData);

        // التحقق من إعادة التوجيه إلى صفحة المستخدمين
        $response->assertRedirect('/control/users');

        // التحقق من وجود المستخدم في قاعدة البيانات
        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com'
        ]);

        // التحقق من أن المستخدم تم تعيينه لدور معين
        $user = User::where('email', 'testuser@example.com')->first();
        $this->assertTrue($user->hasRole($role->name));
    }

    public function testEditUser()
    {
        $user = User::first(); // Get the first user created in setUp

        // Execute the request
        $response = $this->get("/control/users/{$user->id}/edit");

        // Define expected roles and user roles
        $expectedRoles = Role::pluck('name', 'name')->all();
        $expectedUserRoles = $user->roles->pluck('name', 'name')->all();

        // Verify the response
        $response->assertStatus(200);
        $response->assertViewHas('user', $user);
        $response->assertViewHas('roles', $expectedRoles);
        $response->assertViewHas('userRole', $expectedUserRoles);
    }

    public function testUpdateUser()
    {
        $user = User::factory()->create();
        // تحديث بيانات المستخدم
        $newData = [
            'name' => 'Updated User',
            'email' => 'updateduser@example.com',
            'phone' => '711198264',
            'roles_name' => [Role::first()->name],
        ];


        $response = $this->put("/control/users/{$user->id}/update", $newData);

        // التحقق من إعادة التوجيه إلى صفحة المستخدمين
        $response->assertRedirect('/control/users');

        // التحقق من تحديث بيانات المستخدم في قاعدة البيانات
        $this->assertDatabaseHas('users', ['email' => 'updateduser@example.com']);
    }

    public function testDestroyUser()
    {
        $user = User::factory()->create();

        $response = $this->delete("/control/users/{$user->id}/delete");

        // التحقق من إعادة التوجيه إلى صفحة المستخدمين
        $response->assertRedirect('/control/users');

        // التحقق من حذف المستخدم من قاعدة البيانات
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
    public function testIndexProfile()
    {

        // Execute the request
        $response = $this->get('/control/profile');

        // Verify the response
        $response->assertStatus(200);
        $response->assertViewHas('user_info', $this->authUser);
    }

    public function testChangePasswordSuccess()
    {
        // New password and its confirmation
        $newPassword = 'newpassword123';

        // Submit the request
        $response = $this->put('/control/changePassword', [
            'current_password' => 'password123',
            'new_password' => $newPassword,
            'new_password_confirmation' => $newPassword,
        ]);

        // Verify the response
        $response->assertRedirect('/control/profile');
        $response->assertSessionHas('icon', 'success');
        $response->assertSessionHas('msg', 'تم تغيير كلمة المرور بنجاح');

        // Verify that the password was updated in the database
        $this->assertTrue(Hash::check($newPassword, $this->authUser->fresh()->password));
    }

    public function testChangePasswordFailureDueToIncorrectCurrentPassword()
    {
        // Submit the request with an incorrect current password
        $response = $this->put('/control/changePassword', [
            'current_password' => 'wrongpassword',
            'new_password' => 'newpassword123',
            'new_password_confirmation' => 'newpassword123',
        ]);

        // Verify the response
        $response->assertRedirect('/control/profile');
        $response->assertSessionHasErrors(['current_password']);
        $response->assertSessionHas('errors', function ($errors) {
            return $errors->has('current_password');
        });
    }
    public function testUpdateProfile()
    {

        // New profile data
        $newData = [
            'name' => 'Updated User',
            'email' => 'updateduser@example.com',
            'phone' => '711234567',
        ];

        // Perform the request
        $response = $this->put(route('update_profile'), $newData);

        // Verify the response
        $response->assertRedirect('/control/profile');
        $response->assertSessionHas('icon', 'success');
        $response->assertSessionHas('msg', 'تم تعديل الملف الشخصي بنجاح');

        // Verify the user's data was updated
        $this->assertDatabaseHas('users', [
            'id' => $this->authUser->id,
            'name' => 'Updated User',
            'email' => 'updateduser@example.com',
            'phone' => '711234567',
        ]);
    }
}
