<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AssociationController;
use App\Http\Controllers\Admin\DataFilterController;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth', 'verified'])->group(function () {
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'can:view admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::resource('/roles', RoleController::class);
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
    Route::resource('/permissions', PermissionController::class);
    Route::resource('/users', UserController::class)->middleware('can:view users');    
    Route::resource('/associations', AssociationController::class)->middleware('can:view powerbi account(s)');
    Route::resource('/filters', DataFilterController::class)->middleware('can:view filters');
    Route::put('/users/{user}/associate', [UserController::class, 'associateAzureAccount'])->name('associations');
});

require __DIR__ . '/auth.php';