<?php

use App\Http\Controllers\Admin\AboutSectionController;
use App\Http\Controllers\Admin\PortfolioSectionController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Admin\SkillSectionController;
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

Route::get('/', [IndexController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Landing Page
    Route::put('/admin/section-about', [AboutSectionController::class, 'update']);
    Route::resource('/admin/section-about', AboutSectionController::class);

    Route::resource('/admin/section-skill', SkillSectionController::class);

    Route::resource('/admin/section-portfolio', PortfolioSectionController::class);  
    
    // Publikasi
    Route::resource('/admin/project', ProjectController::class);
});
