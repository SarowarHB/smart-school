<?php

use App\Http\Controllers\AssessmentResourceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\QuestionCycleController;
use App\Http\Controllers\QuestionGradeController;
use App\Http\Controllers\QuestionSubjectController;
use App\Http\Controllers\QuestionTypeController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleResourceController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// ─── Auth ────────────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ─── Google OAuth ─────────────────────────────────────────────────────────────
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('auth.google.callback');

// ─── Protected ───────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/', fn () => redirect()->route('dashboard'));
    Route::get('/dashboard', fn () => Inertia::render('Dashboard/Index'))->name('dashboard');

    Route::resource('roles', RoleController::class)->except(['show', 'create', 'edit']);
    Route::put('roles/{role}/resources', [RoleController::class, 'syncResources'])->name('roles.resources');
    Route::resource('role-resources', RoleResourceController::class)->only(['index', 'store', 'destroy']);

    Route::resource('assessment-resources', AssessmentResourceController::class)->except(['show', 'create', 'edit']);
    Route::resource('resources', ResourceController::class)->except(['show', 'create', 'edit']);
    Route::resource('question-cycles', QuestionCycleController::class)->except(['show', 'create', 'edit']);
    Route::resource('question-grades', QuestionGradeController::class)->except(['show', 'create', 'edit']);
    Route::resource('question-subjects', QuestionSubjectController::class)->except(['show', 'create', 'edit']);
    Route::resource('question-types', QuestionTypeController::class)->except(['show', 'create', 'edit']);
});
