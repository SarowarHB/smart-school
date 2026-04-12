<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

// ─── Auth ────────────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ─── Google OAuth ─────────────────────────────────────────────────────────────
Route::get('/auth/google',          [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('auth.google.callback');

// ─── Protected ───────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/',          fn () => redirect()->route('dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Placeholder routes — each returns a simple Inertia render
    Route::get('/analytics',          fn () => inertia('Placeholder', ['title' => 'Analytics']))->name('analytics');
    Route::get('/users',              fn () => inertia('Placeholder', ['title' => 'Users']))->name('users.index');
    Route::get('/users/permissions',  fn () => inertia('Placeholder', ['title' => 'Permissions']))->name('users.permissions');

    // Roles CRUD — must be before any wildcard user routes
    Route::resource('roles', RoleController::class)->except(['show', 'create', 'edit']);
    Route::get('/products',           fn () => inertia('Placeholder', ['title' => 'Products']))->name('products.index');
    Route::get('/products/categories',fn () => inertia('Placeholder', ['title' => 'Categories']))->name('products.categories');
    Route::get('/orders',             fn () => inertia('Placeholder', ['title' => 'Orders']))->name('orders.index');
    Route::get('/invoices',           fn () => inertia('Placeholder', ['title' => 'Invoices']))->name('invoices.index');
    Route::get('/pages',              fn () => inertia('Placeholder', ['title' => 'Pages']))->name('pages.index');
    Route::get('/media',              fn () => inertia('Placeholder', ['title' => 'Media']))->name('media.index');
    Route::get('/settings',           fn () => inertia('Placeholder', ['title' => 'Settings']))->name('settings');
    Route::get('/reports',            fn () => inertia('Placeholder', ['title' => 'Reports']))->name('reports');
    Route::get('/activity',           fn () => inertia('Placeholder', ['title' => 'Activity Log']))->name('activity');
});
