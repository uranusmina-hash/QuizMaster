<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('home');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/change-password', [ProfileController::class, 'changePasswordForm'])->name('change.password.form');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
    
    Route::middleware(['role:user'])->group(function () {
        Route::get('/take-quiz', [QuizController::class, 'show'])->name('quiz.show');
        Route::post('/take-quiz', [QuizController::class, 'saveAnswers'])->name('quiz.save');
        Route::post('/submit-quiz', [QuizController::class, 'submit'])->name('quiz.submit');
        Route::get('/results', [QuizController::class, 'results'])->name('quiz.results');
    });
    
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/panel', [AdminController::class, 'index'])->name('panel');
        Route::post('/questions/store', [AdminController::class, 'storeQuestion'])->name('questions.store');
        Route::post('/questions/{question}/update', [AdminController::class, 'updateQuestion'])->name('questions.update');
        Route::delete('/questions/{question}', [AdminController::class, 'deleteQuestion'])->name('questions.delete');
    });
});