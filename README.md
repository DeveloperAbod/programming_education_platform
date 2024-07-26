# التوثيق للوحة تحكم منصة تعلم البرمجة (لارافيل 11)
 تم انشاء هذا المشروع المصغر لأكاديمية ويست

## في هذه المهمة تم انجاز التالي بالترتيب:
1- قمت بتصميم وترتيب الواجهات مبدأياً.

2- قمت بانشاء مشروع لارافيل جديد.

3- قمت باستخدام مكتبة Laravel ui لتسهيل عمل انشاء المستخدمين وتسجيل وانشاء حساب.

4- قمت بالتعديل على جدول المستخدمين والتصميم الافتراضي وعرض بيانات المستخدم بشكل مرتب.

5-قمت باضافة controller لتعديل الملف الشخصي للمستخدم مع الواجهة الخاصة بالمستخدم للتعديل.

 6-قمت باضافة مكتبة spatie-permission لاضافة الصلاحيات وادارتها مع الصفحات.
 
7- قمت باضافة CRUD الخاص ب المستخدمين و الصلاحيات.

8- قمت باضافة الصلاحيات لكل صفحة موجودة في الموقع او اي عملية.

9-قمت باضافة جدول الدورات وجميع العميات الخاصة به مثل اضافة تعديل حذف -  قبول - رفض - ايقاف - تفعيل. 

## متطلبات التشغيل:
1-ويب سيرفر مثلا xampp

2- نسخة php 8.2 او اعلى

3- تحميلComposer

4-تحميل node package management

## المكتبات المستخدمة:
1-مكتبة laravel ui لتسهيل الاذونات  auth 


يمكنك زيارة الموقع من هنا (https://github.com/laravel/ui)

2-مكتبة spatie permission لتسهيل اضافة الصلاحيات


يمكنك زيارة الموقع من هنا (https://spatie.be/docs/laravel-permission/v6/introduction)


## طريقة التشغيل:
### 1. نسخ المستودع 
ابحث عن مكان على جهاز الكمبيوتر الخاص بك حيث تريد تخزين المشروع

قم بتشغيل وحدة التحكم bash هناك واستنسخ المشروع.

`git clone https://github.com/DeveloperAbod/programming_education_platform.git`

### 2. انتقل الى مسار المشروع
يجب أن تكون داخل مسار المشروع الذي تم إنشاؤه للتو، لذا انتقل إليه.

`cd project_name`

### 3.  تنزيل composer dependencies و NPM dependencies
عندما تقوم باستنساخ مشروع Laravel جديد، يجب عليك الآن تثبيت جميع الحزم المشروع. وهذا ما يؤدي في الواقع إلى تثبيت Laravel نفسه، من بين الحزم الضرورية الأخرى للبدء.



`composer install`


`npm install`

### 5. قم بإنشاء ملف .env (يمكنك تخطي هذا الخطوة لانني عرضت لك ملف .env )

يجب عليك عمل نسخة من ملف .env.example وتسميته .env حتى تتمكن من إعداد الاعدادات الخاص بك, يمكنك النسخ بإستخدام هذا الامر

`cp .env.example .env`

### 6. إنشاء مفتاح تشفير التطبيق app key  (يمكنك تخطي هذا الخطوة لانني عرضت لك ملف .env )


يتطلب Laravel منك أن يكون لديك مفتاح تشفير للتطبيق يتم إنشاؤه عشوائيًا وتخزينه في ملف .env الخاص بك. سيستخدم التطبيق مفتاح التشفير هذا لتشفير عناصر مختلفة من تطبيقك من ملفات تعريف الارتباط إلى تجزئات كلمات المرور والمزيد.
يمكنك انشاء مفتاح باستخدام هذا الامر

`php artisan key:generate`

### 7. قم بانشاء Migrate للجداول 
بمجرد إضافة بيانات الاعتماد الخاصة بك إلى ملف .env، يمكنك الآن تنفيذ عمليات ترحيل قاعدة البيانات. ستؤدي هذه الخطوة إلى إنشاء جميع الجداول اللازمة في قاعدة بياناتك.

`php artisan migrate`

### 8. قم بانشاء seeder للسجلات (اضافة البيانات الاساسية لقاعدة البيانات) 
`php artisan db:seed --class=PermissionTableSeeder`


`php artisan db:seed --class=CreateAdminUserSeeder`

### 9. قم بتشغيل السيرفر محليا
`php artisan serve`

