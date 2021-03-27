<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApplicantsController;
use App\Http\Controllers\DistrictsController;

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

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::middleware(['auth'])->prefix('alifapp')->group(function(){

    Route::get('dashboard', [DashboardController::class, 'summaryDashboard'])->name('dashboard');

    Route::prefix('applicants')->group(function(){

        Route::get('list', [ApplicantsController::class, 'index'])->name('applicant.list');

        Route::get('applicant-form/{id?}', [ApplicantsController::class, 'applicantForm'])->name('applicant.applicant-form');

        Route::post('save', [ApplicantsController::class, 'save'])->name('applicant.save');

        Route::get('applicant-profile/{id}', [ApplicantsController::class, 'applicantProfile'])->name('applicant.applicant-profile');

        Route::post('save-health-information', [ApplicantsController::class, 'saveHealthInformation'])->name('applicant.save-health-information');

        Route::post('save-sibling', [ApplicantsController::class, 'saveSibling'])->name('applicant.save-sibling');

        Route::post('save-academic', [ApplicantsController::class, 'saveAcademic'])->name('applicant.save-academic');

        Route::get('delete-academic/{id}', [ApplicantsController::class, 'deleteAcademic'])->name('applicant.delete-academic');

        Route::get('delete-sibling/{id}', [ApplicantsController::class, 'deleteSibling'])->name('applicant.delete-sibling');

    });


    Route::prefix('districts')->group(function(){

        Route::post('districts-by-province-id', [DistrictsController::class, 'districtsByProvinceId'])->name('districts-by-province-id');

    });


});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/

require __DIR__.'/auth.php';
