<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
Route::get('/',[PageController::class,'home'])->name('home');
Route::get('/tasks',[TaskController::class,'index'])->name('tasks.index');
Route::get('/profile',[ProfileController::class,'show'])->name('profile');
Route::get('/about',[PageController::class,'about'])->name('about');
Route::middleware('guest')->group(function (): void {
    Route::get('/login',[AuthenticatedSessionController::class,'create'])->name('login');
    Route::post('/login',[AuthenticatedSessionController::class,'store'])->name('login.store');
    Route::get('/register',[RegisteredUserController::class,'create'])->name('register');
    Route::post('/register',[RegisteredUserController::class,'store'])->name('register.store');
});
Route::post('/logout',[AuthenticatedSessionController::class,'destroy'])->middleware('auth')->name('logout');
Route::middleware('auth')->group(function (): void {
    Route::get('/tasks/create',[TaskController::class,'create'])->name('tasks.create');
    Route::post('/tasks',[TaskController::class,'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit',[TaskController::class,'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}',[TaskController::class,'update'])->name('tasks.update');
    Route::delete('/tasks/{task}',[TaskController::class,'destroy'])->name('tasks.destroy');
});
