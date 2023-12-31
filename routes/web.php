<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\KomoditasController;
use App\Http\Controllers\Admin\KonsultasiController;
use App\Http\Controllers\Admin\LinkController;
use App\Http\Controllers\Admin\MitraController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PenyakitController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProfilKlinik;
use App\Http\Controllers\Admin\ProfilKlinikController;
use App\Http\Controllers\Admin\ProfpegController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SosmedController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware('visitor')->group(function () {
    Route::get('/', [PageController::class, 'index']);
    Route::get('/profil-dinas', [PageController::class, 'profil_dinas'])->name('profil_dinas');

    Route::prefix('klinik')->group(function () {
        Route::get('/profil-klinik', [PageController::class, 'profil_klinik'])->name('profil_klinik');
        Route::get('/profil-klinik/{profil__kliniks:slug}', [PageController::class, 'profil_klinik_detail'])->name('profil_klinik_detail');
        Route::get('/aktivitas-klinik', [PageController::class, 'artikel'])->name('artikel');
        Route::get('/aktivitas-klinik/{news:slug}', [PageController::class, 'artikel_detail'])->name('artikel-detail');
        Route::get('/mitra', [PageController::class, 'mitra'])->name('mitra');
        Route::get('/hpt', [PageController::class, 'penyakit'])->name('penyakit');
        Route::get('/hpt/{penyakits:slug}', [PageController::class, 'penyakit_detail'])->name('penyakit-detail');
    });

    Route::prefix('komoditas')->group(function () {
        Route::get('/unggulan-daerah', [PageController::class, 'komoditas_unggulan'])->name('komoditas_unggulan');
        Route::get('/lainnya', [PageController::class, 'komoditas_lainnya'])->name('komoditas_lainnya');
        Route::get('/{komoditas:slug}', [PageController::class, 'komoditas_detail'])->name('komoditas-detail');
        // Route::get('/kebijakan-pengembangan-komoditas/{profil__kliniks:slug}', [PageController::class, 'kebijakan_detail'])->name('kebijakan_detail');
    });

    Route::get('/kebijakan-pengembangan-komoditas', [PageController::class, 'kebijakan'])->name('kebijakan');
    Route::get('/konsultasi', [PageController::class, 'konsultasi'])->name('konsultasi');

    Route::prefix('galeri')->group(function () {
        Route::get('/foto', [PageController::class, 'galeri_foto'])->name('galeri_foto');
        Route::get('/video', [PageController::class, 'galeri_video'])->name('galeri_video');
    });

    Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
});

Route::prefix('bolmongmaju/disbun')->group(function () {
    Auth::routes([
        'register' => false,
        'reset'    => false,  // for resetting passwords
        'confirm'  => false, // for additional password confirmations
        'verify'   => false, // for email verification
    ]);
});

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
        Route::resource('news', NewsController::class);
        Route::resource('permission', PermissionController::class);
        Route::resource('role', RoleController::class);
        Route::resource('user', UserController::class);
        Route::resource('profile', ProfileController::class);
        Route::resource('contact', ContactController::class);
        Route::resource('link', LinkController::class);
        Route::resource('sosmed', SosmedController::class);
        Route::resource('tag', TagController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('profpeg', ProfpegController::class);
        Route::resource('photo', PhotoController::class);
        Route::resource('video', VideoController::class);
        Route::resource('slider', SliderController::class);
        Route::resource('faq', FaqController::class);
        Route::resource('penyakit', PenyakitController::class);
        Route::resource('komoditas', KomoditasController::class);
        Route::resource('mitra', MitraController::class);
        Route::resource('profil_klinik', ProfilKlinikController::class);
        Route::resource('konsultasi', KonsultasiController::class);
    });
});
