<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('language');

Route::get('/', [FrontController::class, 'index'])->name('index');

Route::get('/contact', function () {
    return view('user.contact');
})->name('contact');

Route::get('/about', function () {
    return view('user.about');
})->name('about');

Route::get('/chat', function () {
    return view('user.chat');
})->name('chat');

Route::post('/chat', ChatController::class);

Route::middleware('auth')->group(function () {
    Route::get('/services/{category}/', [FrontController::class, 'cat_show'])->name('cat_show');
    Route::get('show_worker/{worker}', [FrontController::class, 'worker_show'])->name('worker_show');

    Route::post('request_post', [FrontController::class, 'request_post'])->name('request_post');
});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('/category', CategoryController::class);
    Route::resource('/worker', WorkerController::class);
    Route::resource('/appointment', AppointmentController::class);
    Route::resource('/request', RequestController::class);

    Route::get('calendar/{id}', [AdminController::class, 'calendar'])->name('admin.calendar');

    Route::resource('/admin', AdminController::class);

});

require __DIR__ . '/auth.php';