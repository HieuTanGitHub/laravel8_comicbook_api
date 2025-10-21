<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DanhmucController;
use App\Http\Controllers\TruyenController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ChapterTranhController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TheloaiController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\TruyenTranhController;
use App\Http\Controllers\GoogleDrive;
use App\Http\Controllers\Auth\LoginController;


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

Route::get('/', [IndexController::class, 'home']);
Route::get('/sachtruyen_admin', [LoginController::class, 'login'])->name('login');
Route::get('/danh-muc/{slug}', [IndexController::class, 'danhmuc']);
Route::get('/xem-truyen/{slug}', [IndexController::class, 'xemtruyen']);
Route::get('/xem-chapter/{slug_truyen}/{slug}', [IndexController::class, 'xemchapter']);
Route::get('/xem-truyen-tranh/{slug_truyen}/{slug}', [IndexController::class, 'xemtruyentranh']);
Route::get('/the-loai/{slug}', [IndexController::class, 'theloai']);
Route::get('/truyen-tranh', [IndexController::class, 'truyentranh']);
Route::get('/truyen-tranh/{slug}', [IndexController::class, 'xemtruyentranh'])->name('xemtruyentranh');
Route::post('/chapter-truyen-tranh', [IndexController::class, 'chaptertruyentranh'])->name('chaptertruyentranh');
Route::get('/the-loai-truyen-tranh/{slug}', [IndexController::class, 'the_loai_truyen_tranh'])->name('the-loai-truyen-tranh');
Route::get('/danh-sach/{slug}', [IndexController::class, 'danhsach'])->name('danh-sach');
Route::get('/search-truyentranh', [IndexController::class, 'search_truyentranh'])->name('search-truyentranh');


Route::post('/show-tranh', [IndexController::class, 'show_tranh']);
Route::get('/tag/{tag}', [IndexController::class, 'tag']);

Route::post('/tim-kiem', [IndexController::class, 'timkiem']);
Route::post('/timkiem-ajax', [IndexController::class, 'timkiem_ajax']);

// Auth::routes();
Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...

]);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('/danhmuc', DanhmucController::class);
Route::resource('/truyen', TruyenController::class);
Route::resource('/chapter', ChapterController::class);
Route::resource('/theloai', TheloaiController::class);
Route::resource('/information', InformationController::class);
Route::resource('/truyentranh', TruyenTranhController::class);
Route::resource('/chaptertranh', ChapterTranhController::class);


Route::get('chapter_truyentranh/{slug}', [ChapterTranhController::class, 'chapter_truyentranh']);

Route::get('delete-file/{filename}/{extension}/{timestamp}', [ChapterTranhController::class, 'delete_file']);



Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
  \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/storage-link', function () {
  return Artisan::call('storage:link');
});
