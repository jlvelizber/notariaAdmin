<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FormDocController;
use App\Http\Controllers\UserFormRequestController;
use App\Http\Resources\UserLogggedResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return new UserLogggedResource($request->user());
});

Route::middleware('auth:sanctum')->put('/user', [ AuthenticatedSessionController::class, 'updateUserApi' ] )->name('api.updateUser');

Route::middleware('guest')->post('/register', [ RegisteredUserController::class, 'registerApi' ] )->name('api.register');
Route::middleware('guest')->post('/login', [ AuthenticatedSessionController::class, 'storeApi' ] )->name('api.login');
Route::middleware(['throttle:6,1'])->get('/email/verify/{id}/{hash}', [ AuthenticatedSessionController::class, 'verifyApiAccount' ] )->name('api.account.verify');

Route::get('paises', [CountryController::class, 'listCountries'] )->name('api.paises');
Route::get('tipos-documentos/{formType}', [FormDocController::class, 'getFormsByCategory'] )->name('api.permisosSalida');



Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('mis-solicitudes', [UserFormRequestController::class, 'getMyRequests'] )->name('api.myRequests');
    Route::get('get-documento/{formCode}', [FormDocController::class, 'getFormByCode'] )->name('api.permisosSalida');
    Route::post('save-request', [UserFormRequestController::class, 'postSaveRequestClient'] )->name('api.saveRequestClient');


});