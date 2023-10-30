<?php

use App\Http\Controllers\FormDocTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFormRequestController;
use App\Models\FormDocType;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->get('/', function () {
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
    return redirect()->to('/login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Solicitudes
    Route::get('requests', [UserFormRequestController::class, 'index'])->name('requests.index');
    Route::get('requests/download-file/{path}/{url}', [UserFormRequestController::class, 'downloadFile'])->name('requests.downloadFile');
    Route::get('requests/{formDocType}', [UserFormRequestController::class, 'listRequestsByFormType'])->name('requests.formDocType.index');
    Route::get('requests/{userFormRequest}', [UserFormRequestController::class, 'show'])->name('requests.show');
    Route::get('requests/{userFormRequest}/edit', [UserFormRequestController::class, 'edit'])->name('requests.edit');
    Route::put('requests/{userFormRequest}', [UserFormRequestController::class, 'update'])->name('requests.update');


    Route::resource('roles', RoleController::class)->except('show');
    Route::resource('users', UserController::class)->except('show');

    Route::get('requests/generate/{userFormRequest}', [ReportController::class,'generateRequestDoc'])->name('requests.generate');
});

require __DIR__.'/auth.php';
