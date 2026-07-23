<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MvController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login',[AuthController::class,'showlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth')->group(function () {
Route::get('/',[TemplateController::class,'index'])->name('home');
Route::get('/user',[UserController::class,'index'])->name('user');
Route::get('/mv',[MvController::class,'index'])->name('mv');
Route::get('/mv/form',[MvController::class,'form'])->name('mvs.form');
Route::post('/mv/form',[MvController::class,'store1'])->name('mvs.store1');
Route::get('/users/create',[UserController::class,'create'])->name('users.create');
Route::post('/users/create',[UserController::class,'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::get('users/{id}/admin', [UserController::class, 'admin'])->name('user.admin');
Route::put('/users/{id}/edit', [UserController::class, 'update'])->name('user.update');
Route::get('/users/{id}/delete', [UserController::class, 'destroy'])->name('user.delete');
Route::get('mv/{id}/editvm', [MvController::class, 'edit'])->name('mv.editvm');
Route::put('/mv/{id}/editvm', [MvController::class, 'update'])->name('mv.update');
Route::get('/mv/{id}/delete', [MvController::class, 'destroy'])->name('mv.delete');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// First login configuration setup routes
Route::post('/setup', [TemplateController::class, 'setup'])->name('setup.save');
Route::post('/setup/skip', [TemplateController::class, 'skipSetup'])->name('setup.skip');

// Profile avatar management routes
Route::post('/users/{id}/avatar', [UserController::class, 'uploadAvatar'])->name('profile.avatar.upload');
Route::delete('/users/{id}/avatar', [UserController::class, 'deleteAvatar'])->name('profile.avatar.delete');

// Serverless storage fallback route to serve logos/avatars
Route::get('/storage/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);
    if (!file_exists($path)) {
        $path = '/tmp/storage/app/public/' . $filename;
    }
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->where('filename', '.*')->name('storage.fallback');
});




