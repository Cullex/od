<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\OverdraftController;
use App\User;
use Illuminate\Support\Facades\Route;

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


//generate and access system reports
Route::get('/systemReports', [ReportsController::class, 'index']);

Route::middleware('guest')->group(function (){
    Route::get('/login' , [ AuthController::class , 'loginView' ])->name('login');
    Route::post('/login' , [ AuthController::class , 'login']);
    Route::get('/register', [AuthController::class, 'registerView'])->name('registerView');

});
     /*
     * Vacancies
     *
     */

Route::post('/addVacancy', [VacancyController::class, 'store']);
Route::get('/showVacancies', [VacancyController::class, 'index']);
Route::get('/viewVacancy/{model}', [VacancyController::class, 'show']);

/*
     * Overdrafts
     *
     */
//approve application
Route::post('/approveOverdraftApplication/{model}', [OverdraftController::class, 'store']);
// apply overdraft
Route::post('/applyOverdraft', [OverdraftController::class, 'applyOverdraft']);
//revoke application
Route::post('/revokeOverdraftApplication/{model}', [OverdraftController::class, 'revokeApplication']);
//return list of rejected applications
Route::get('/revokedApplications', [OverdraftController::class, 'revokedApplications']);
//return list of approved applications
Route::get('/approvedApplications', [OverdraftController::class, 'approvedApplications']);
//return list of received applications
Route::get('/receivedOverdraftApplications', [OverdraftController::class, 'index']);
//view selected overdraft application
Route::get('/viewOverdraftApplication/{model}', [OverdraftController::class, 'viewOverdraftApplication']);

/*
     * Applications
     *
     */
Route::post('/applyJob/{model}', [ApplicationController::class, 'apply']);
//display all vacancies
Route::get('/appliedVacancies', [ApplicationController::class, 'appliedVacancies']);
//display selected application to revoke
Route::get('/selectApplication/{model}', [ApplicationController::class, 'selectApplication']);
//revoke application
Route::post('/revokeApplication/{model}', [ApplicationController::class, 'revokeApplication']);
//display received applications for admin
Route::get('/receivedApplications', [ApplicationController::class, 'receivedApplications']);
//view selected application admin
Route::get('/viewOverApplication/{model}', [ApplicationController::class, 'viewApplication']);

/*
     * Shortlisting
     *
     */
Route::post('/shortlist/{model}', [ApplicationController::class, 'shortlist']);
//return shortlisted applications
Route::get('/shortListed', [ApplicationController::class, 'shortListed']);
//return selected shortlisted applicant
Route::get('/viewShortList/{model}', [ApplicationController::class, 'viewShortList']);
//revoke shortlisting
Route::post('/revokeShortListing/{model}', [ApplicationController::class, 'revokeShortListing']);

/*
     * Roles Management
     *
     */
Route::get('/allUsers',[AccessController::class, 'index']);
//return user profile to edit
Route::get('/editUser/{model}', [AccessController::class, 'edit']);
//update profile
Route::post('/updateUser/{model}', [AccessController::class, 'update']);

/*
     * file/documents
     *
     */
/* Files Routes */
Route::post('/upload', [FileController::class, 'upload']);
Route::prefix('documents')->group(function (){
    Route::get("/{id}/{type}/list" , [DocumentController::class , 'index']);
    Route::post("/{id}/{type}/upload" , [DocumentController::class , 'upload']);
    Route::get("/{document}/download" , [DocumentController::class , 'download']);
    Route::get("/{document}/delete" , [DocumentController::class , 'delete']);
});


Route::post('/logout' , [AuthController::class , 'logout'])->name('logout');
Route::post('/registerUser', [AuthController::class, 'registerUser'])->name('registerUser');
Route::get('/password/reset' , [AuthController::class , 'getResetForm']);
Route::post('/password/reset' , [AuthController::class , 'reset']);
Route::post('/reset' , [AuthController::class , 'resetPassword']);

Route::middleware('auth')->group(function (){

    Route::post('/password' , [AuthController::class , 'password']);
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

    /*
     * Users
     *
     */

    Route::prefix('users')->group(function (){
        Route::get('/' ,  [UserController::class , 'index'])->middleware('can:admin,'. User::class);
        Route::post('/create' ,  [UserController::class , 'store'])->middleware('can:admin,'. User::class);
        Route::get('/{model}/view' ,  [UserController::class , 'view'])->middleware('can:admin,'. User::class);
        Route::get('/{model}/activate' ,  [UserController::class , 'activate'])->middleware('can:admin,'. User::class);
        Route::get('/{model}/deactivate' ,  [UserController::class , 'deactivate'])->middleware('can:admin,'. User::class);
        Route::post('/{model}/update' ,  [UserController::class , 'update'])->middleware('can:admin,'. User::class);
    });

    Route::prefix('roles')->group(function (){
        Route::get('/' ,  [RoleController::class , 'index']);
        Route::post('/create' ,  [RoleController::class , 'store']);
        Route::get('/{model}/view' ,  [RoleController::class , 'view']);
        Route::post('/{model}/update' ,  [RoleController::class , 'update']);
    });

    Route::prefix('permissions')->group(function (){
        Route::get('/' ,  [PermissionController::class , 'index']);
    });

});



