<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseTest extends TestCase
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
        $response = $this->get('/control/courses');

        $response->assertStatus(200);
        $response->assertViewHas('courses');
    }

    public function testShow()
    {
        $course = Course::factory()->create();
        $response = $this->get("/control/courses/{$course->id}/show");

        $response->assertStatus(200);
        $response->assertViewHas('course_info');
    }

    public function testCreate()
    {
        $response = $this->get('/control/courses/create');

        $response->assertStatus(200);
    }

    public function testStore()
    {
        Storage::fake('uploads');

        $courseData = [
            'name' => 'Test Course',
            'shortcut' => 'TC',
            'price' => 100,
            'image' => UploadedFile::fake()->image('course.jpg'),
            'description' => 'This is a test course description.',
        ];

        $response = $this->post('/control/courses/store', $courseData);

        $response->assertRedirect('/control/courses');
        $this->assertDatabaseHas('courses', ['name' => 'Test Course']);
    }

    public function testEdit()
    {
        $course = Course::factory()->create();
        $response = $this->get("/control/courses/{$course->id}/edit");

        $response->assertStatus(200);
        $response->assertViewHas('course_info');
    }

    public function testUpdate()
    {
        $course = Course::factory()->create();

        Storage::fake('uploads');

        $courseData = [
            'name' => 'Updated Course',
            'shortcut' => 'UC',
            'price' => 200,
            'image' => UploadedFile::fake()->image('updated.jpg'),
            'description' => 'Updated course description.',
        ];

        $response = $this->put("/control/courses/{$course->id}/update", $courseData);

        $response->assertRedirect('/control/courses');
        $this->assertDatabaseHas('courses', ['name' => 'Updated Course']);
        $this->assertDatabaseHas('courses', ['id' => $course->id, 'status' => -1]);
    }

    public function testDestroy()
    {
        $course = Course::factory()->create();

        $response = $this->delete("/control/courses/{$course->id}/delete");

        $response->assertRedirect('/control/courses');
        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
    }

    public function testPendingCourses()
    {
        $pendingCourse  = Course::factory()->create(['status' => 0]);
        $response = $this->get('/control/courses/pending-courses');

        $response->assertStatus(200);
        $response->assertViewHas('pending_courses', function ($courses) use ($pendingCourse) {
            // Check if the retrieved courses contain the pending course created
            return $courses->contains($pendingCourse);
        });
    }
    public function testShowPendingCourse()
    {
        // Arrange: Create a sample course in the database
        $course = Course::factory()->create(['status' => 0]);

        // Act: Make a request to the pending_course method
        $response = $this->get("/control/courses/{$course->id}/pending-course");

        // Assert: Check the response and view data
        $response->assertStatus(200);
        $response->assertViewIs('admin.courses.pending_course');
        $response->assertViewHas('course_info', function ($viewCourse) use ($course) {
            return $viewCourse->id === $course->id;
        });
    }

    public function testUpdatePendingCourse()
    {
        $course = Course::factory()->create(['status' => 0]);

        $response = $this->put("/control/courses/{$course->id}/update-pending-course", ['accept' => true]);

        $response->assertRedirect('/control/courses/pending-courses');
        $this->assertDatabaseHas('courses', ['id' => $course->id, 'status' => 1]);
    }

    public function testActive()
    {
        $course = Course::factory()->create(['status' => 2]);

        $response = $this->get("/control/courses/{$course->id}/active");

        $response->assertRedirect('/control/courses');
        $this->assertDatabaseHas('courses', ['id' => $course->id, 'status' => 1]);
    }

    public function testDeactivate()
    {
        $course = Course::factory()->create(['status' => 1]);

        $response = $this->get("/control/courses/{$course->id}/deactivate");

        $response->assertRedirect('/control/courses');
        $this->assertDatabaseHas('courses', ['id' => $course->id, 'status' => 2]);
    }
}
