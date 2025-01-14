<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\RecruitController;
use App\Http\Controllers\Admin\YoutubeMovieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

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

//Route::get('/', 'HomeController@index')->name('home.index');

Route::group([
    'namespace' => 'admin',
    'prefix' => 'admin'
], function () {
    Route::get('login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login.post');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
});

Route::group([
    'namespace' => 'admin',
    'middleware' => 'admin',
    'prefix' => 'admin'
], function () {
    Route::get('/', [IndexController::class, 'index'])->name('admin.index');
    Route::get('recruit', [RecruitController::class, 'index'])->name('admin.recruit');
    Route::get('recruit/{recruit_id}', [RecruitController::class, 'show'])->name('admin.recruit.show');
    Route::delete('recruit/{recruit_id}', [RecruitController::class, 'destroy'])->name('admin.recruit.destroy');
    Route::get('contact', [ContactController::class, 'index'])->name('admin.contact');
    Route::get('contact/{contact_id}', [ContactController::class, 'show'])->name('admin.contact.show');
    Route::delete('contact/{contact_id}', [ContactController::class, 'destroy'])->name('admin.contact.destroy');

    // 画像一覧
    Route::get('gallery', [GalleryController::class, 'index'])->name('admin.gallery');
    Route::get('gallery/create', [GalleryController::class, 'create'])->name('admin.gallery.create');
    Route::post('gallery/create', [GalleryController::class, 'store'])->name('admin.gallery.store');
    Route::put('gallery', [GalleryController::class, 'updateFlg'])->name('admin.gallery.update_flg');
    Route::get('gallery/show/{gallery_id}', [GalleryController::class, 'show'])->name('admin.gallery.show');
    Route::get('gallery/edit/{gallery_id}', [GalleryController::class, 'edit'])->name('admin.gallery.edit');
    Route::post('gallery/update', [GalleryController::class, 'update'])->name('admin.gallery.update');
    Route::delete('gallery/{gallery_id}', [GalleryController::class, 'destroy'])->name('admin.gallery.destroy');
    // 動画一覧
    Route::get('movie', [MovieController::class, 'index'])->name('admin.movie');
    Route::get('movie/create', [MovieController::class, 'create'])->name('admin.movie.create');
    Route::post('movie/create', [MovieController::class, 'store'])->name('admin.movie.store');
    Route::put('movie', [MovieController::class, 'updateFlg'])->name('admin.movie.update_flg');
    Route::get('movie/show/{movie_id}', [MovieController::class, 'show'])->name('admin.movie.show');
    Route::get('movie/edit/{movie_id}', [MovieController::class, 'edit'])->name('admin.movie.edit');
    Route::post('movie/update', [MovieController::class, 'update'])->name('admin.movie.update');
    Route::delete('movie/{movie_id}', [MovieController::class, 'destroy'])->name('admin.movie.destroy');
    // youtube動画一覧
    Route::get('youtube_movie', [YoutubeMovieController::class, 'index'])->name('admin.youtube_movie');
    Route::get('youtube_movie/show/{youtube_movie_id}', [YoutubeMovieController::class, 'show'])
        ->name('admin.youtube_movie.show');
    Route::put('youtube_movie', [YoutubeMovieController::class, 'updateFlg'])->name('admin.youtube_movie.update_flg');
    Route::delete('youtube_movie/{youtube_movie_id}', [YoutubeMovieController::class, 'destroy'])
        ->name('admin.youtube_movie.destroy');
});

//Route::get('admin/index', [IndexController::class, 'index'])->name('admin.index');

// 管理画面
//Route::view('admin', 'admin.index');





Route::view('/{any?}', 'home.index')->where('any', '.*');





