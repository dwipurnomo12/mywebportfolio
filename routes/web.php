<?php

use App\Http\Controllers\Admin\AboutSectionController;
use App\Http\Controllers\Admin\PortfolioSectionController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Admin\SkillSectionController;
use App\Http\Controllers\LpProjectsController;
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

Route::get('/detail-project/{projects:slug}', [LpProjectsController::class, 'detailProject']);
Route::get('/projects', [LpProjectsController::class, 'projects']);


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

    Route::POST('/admin/section-resume/pendidikan-store', [ResumeController::class, 'pendidikanStore']);
    Route::POST('/admin/section-resume/pekerjaan-store', [ResumeController::class, 'pekerjaanStore']);
    Route::resource('/admin/section-resume', ResumeController::class);  

    
    // Publikasi
    Route::get('/admin/project/checkSlug', [ProjectController::class, 'checkSlug'])->middleware('auth');
    Route::post('/admin/project/create', [ProjectController::class, 'store']);
    Route::resource('/admin/project', ProjectController::class);
});
