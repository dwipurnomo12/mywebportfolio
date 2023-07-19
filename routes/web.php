<?php

use App\Http\Controllers\Admin\AboutSectionController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ContactSectionController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PortfolioSectionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Admin\SkillSectionController;
use App\Http\Controllers\LpCommentController;
use App\Http\Controllers\LpKategoriController;
use App\Http\Controllers\LpPostsController;
use App\Http\Controllers\LpProjectsController;
use App\Http\Controllers\NavbarPostController;
use App\Models\Kategori;
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

Route::get('/post/{posts:slug}', [LpPostsController::class, 'detailPost']);
Route::get('/posts', [LpPostsController::class, 'posts']);

Route::post('/post/{slug}', [LpCommentController::class, 'store']);
Route::post('/post/{slug}/reply', [LpCommentController::class, 'storeReply']);

Route::get('/partials/navbarpost', [NavbarPostController::class, 'index']);

Route::get('/kategori/{kategori:slug}', [LpKategoriController::class, 'index']);

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

    Route::get('/admin/section-contact/', [ContactSectionController::class, 'index']);
    
    // Publikasi
    Route::get('/admin/project/checkSlug', [ProjectController::class, 'checkSlug']);
    Route::post('/admin/project/create', [ProjectController::class, 'store']);
    Route::resource('/admin/project', ProjectController::class);

    Route::get('/admin/posts/checkSlug', [PostController::class, 'checkSlug']);
    Route::post('/admin/posts/create', [PostController::class, 'store']);
    Route::resource('/admin/posts', PostController::class);

    Route::get('/admin/kategori/fetchData', [KategoriController::class, 'fetchData']);
    Route::get('/admin/kategori/checkSlug', [KategoriController::class, 'checkSlug']);
    Route::resource('/admin/kategori', KategoriController::class);

    Route::post('/admin/komentar/{id}', [CommentController::class, 'store']);
    Route::delete('/admin/komentar/{id}/reply', [CommentController::class, 'deleteReply']);
    Route::resource('/admin/komentar', CommentController::class);
});
