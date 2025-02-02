<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KategoriPengaduanController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\RekapController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ResidentController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'index_login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/admin', [AuthController::class, 'admin_login'])->name('login-admin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::post('/register', [AuthController::class, 'register'])->name('register-akun');
Route::get('/forgot-password', [AuthController::class, 'index_forgot'])->name('password.email');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.reset');

Route::prefix('user')->name('user.')->middleware(['auth', 'is_user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'user_index'])->name('dashboard');
    Route::post('/pengaduan', [\App\Http\Controllers\User\PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/create', [\App\Http\Controllers\User\PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::get('/pengaduan', [\App\Http\Controllers\User\PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/show/{id}', [\App\Http\Controllers\User\PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::get('/pengaduan/edit/{id}', [\App\Http\Controllers\User\PengaduanController::class, 'edit'])->name('pengaduan.edit');
    Route::put('/pengaduan/{id}', [\App\Http\Controllers\User\PengaduanController::class, 'update'])->name('pengaduan.update');
    Route::delete('/pengaduan/{id}', [\App\Http\Controllers\User\PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
    Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profil-edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil-edit', [ProfileController::class, 'update_user'])->name('profile.update');
    Route::post('/profil/upload', [ProfileController::class, 'uploadAvatar'])->name('profile.upload');

});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin_index'])->name('dashboard');
    Route::resource('/Admin', AdminController::class);
    Route::resource('/resident', ResidentController::class);
    Route::post('/resident/upload/{id}', [ResidentController::class, 'uploadAvatar'])->name('resident.upload');
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::post('/pengaduan/{id}/status', [PengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');
    Route::post('/pengaduan/{id}/tanggapan', [PengaduanController::class, 'addTanggapan'])->name('pengaduan.addTanggapan');
    Route::put('/admin/pengaduan/{id}/complete', [PengaduanController::class, 'markAsCompleted'])->name('pengaduan.markAsCompleted');
    Route::put('/admin/pengaduan/{id}/reject', [PengaduanController::class, 'reject'])->name('pengaduan.reject');
    Route::resource('kategori_pengaduan', controller: KategoriPengaduanController::class);
    Route::get('rekap-Pengaduan', [RekapController::class, 'index'])->name('rekap.index');
    Route::get('rekap-Pengaduan/export-pdf', [RekapController::class, 'exportPdf'])->name('rekap.export-pdf');
    Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profil-edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil-edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profil/upload', [ProfileController::class, 'uploadAvatar'])->name('profile.upload');

});


