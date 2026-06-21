<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// الصفحة الرئيسية
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// لوحة التحكم العامة
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// المسارات المحمية (يجب تسجيل الدخول للوصول إليها)
Route::middleware(['auth'])->group(function () {
    // ملف المستخدم
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // مسارات الوظائف الشاملة (عرض، إضافة، تعديل، حذف)
    // هذا السطر يغني عن كتابة كل مسار لوحده ويُفعل دالة destroy تلقائياً
    Route::resource('jobs', JobController::class)->except(['index']); 
});

// مسار عرض الوظائف (متاح للجميع أو حسب رغبتك)
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');

// مسار تبديل اللغة
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['ar', 'tr', 'en'])) {
        session()->put('locale', $locale);
        session()->save(); 
    }
    return redirect()->back();
})->name('language.switch');

require __DIR__.'/auth.php';