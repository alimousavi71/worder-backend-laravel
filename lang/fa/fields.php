<?php

/*
|--------------------------------------------------------------------------
| Authentication Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used during authentication for various
| messages that we need to display to the user. You are free to modify
| these language lines according to your application's requirements.
|
*/

return [

    'category' => [
        'id' => 'شناسه',
        'created_at' => 'تاریخ ایجاد',
        'title' => 'عنوان',
        'description' => 'توضیحات',
        'icon' => 'تصویر',
        'type' => 'نوع',
    ],
    'acf-template' => [
        'id' => 'شناسه',
        'title' => 'عنوان',
        'photo' => 'تصویر',
        'description' => 'توضیحات',
        'template' => 'فایل قالب',
        'created_at' => 'تاریخ ایجاد',
    ],
    'avatar' => [
        'id' => 'شناسه',
        'created_at' => 'تاریخ ایجاد',
        'icon' => 'تصویر',
    ],
    'admin' => [
        'id' => 'شناسه',
        'created_at' => 'تاریخ ایجاد',
        'avatar' => 'آواتار',
        'email' => 'ایمیل',
        'first_name' => 'نام',
        'last_name' => 'نام خانوادگی',
        'password' => 'گذرواژه',
        'role' => 'سطح دسترسی',
        'has_access' => 'دسترسی دارد',
        'current_password' => 'گذرواژه فعلی',
        'new_password' => 'گذرواژه جدید',
        'repeat_password' => 'تکرار گذرواژه',
    ],
    'role' => [
        'id' => 'شناسه',
        'created_at' => 'تاریخ ایجاد',
        'name' => 'نام سطح دسترسی',
        'permissions' => 'مجوز ها',
        'select_all' => 'انتخاب همه',
        'remove_selected' => 'حذف انتخاب ها',
    ],
    'contact' => [
        'id' => 'شناسه',
        'created_at' => 'تاریخ ایجاد',
        'email' => 'ایمیل',
        'is_seen' => 'دیده شده',
        'is_public' => 'منتشر شده',
        'is_collaboration' => 'درخواست همکاری',
        'comment' => 'متن پیام',
        'agent' => 'عامل',
        'delete' => 'حذف',
    ],
    'sentence' => [
        'id' => 'شناسه',
        'created_at' => 'تاریخ ایجاد',
        'category_id' => 'دسته بندی',
        'sentence' => 'جمله',
        'status' => 'وضعیت',
        'title' => 'عنوان',
        'translate' => 'ترجمه',
    ],
    'word' => [
        'id' => 'شناسه',
        'word' => 'کلمه',
        'translate' => 'ترجمه',
        'description' => 'توضیحات',
        'category_id' => 'دسته بندی',
        'user_id' => 'کاربر',
        'status' => 'وضعیت',
        'created_at' => 'تاریخ ایجاد',
    ],
    'profile' => [
        'id' => 'شناسه',
        'word' => 'کلمه',
        'translate' => 'ترجمه',
        'description' => 'توضیحات',
        'category_id' => 'دسته بندی',
        'user_id' => 'کاربر',
        'status' => 'وضعیت',
        'created_at' => 'تاریخ ایجاد',
    ],
    'exam' => [
        'id' => 'شناسه',
        'title' => 'عنوان',
        'type' => 'نوع آزمون',
        'user_id' => 'کاربر',
        'grade' => 'نمره',
        'is_timer_on' => 'تایمر روشن',
        'is_word_knew' => 'از کلماتی که میدونستم',
        'is_my_words' => 'از کلمات خودم',
        'created_at' => 'تاریخ ایجاد',
    ],
    'user' => [
        'id' => 'شناسه',
        'login_at' => 'تاریخ ورود',
        'ip' => 'آی پی',
        'agent' => 'ایجنت',
        'firstname' => 'نام',
        'lastname' => 'نام خانوادگی',
        'avatar' => 'آواتار',
        'email' => 'ایمیل',
        'email_verified_at' => 'تایید شده',
        'password' => 'گذرواژه',
        'deleted_at' => 'تاریخ حذف',
        'created_at' => 'تاریخ ایجاد',
        'updated_at' => 'تاریخ به روزرسانی',
        'remember_token' => 'تاریخ اعتبار توکن',
        'words_count' => 'تعداد کلمات',
    ],
];
