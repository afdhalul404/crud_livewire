<?php

use App\Http\Controllers\PublicController;
use App\Http\Livewire\Admin\BukuComponent;
use App\Http\Livewire\Admin\DashboardComponent;
use App\Http\Livewire\Admin\DetailBuku;
use App\Http\Livewire\Admin\DetailKp;
use App\Http\Livewire\Admin\DetailSkripsi;
use App\Http\Livewire\Admin\DosenComponent;
use App\Http\Livewire\Admin\KpComponent;
use App\Http\Livewire\Admin\Layouts\Index;
use App\Http\Livewire\Admin\SkripsiComponent;
use App\Http\Livewire\Auth\AdminLoginComponent;
use App\Http\Livewire\Auth\AdminRegisterComponent;
use App\Http\Livewire\Auth\LoginComponent;
use App\Http\Livewire\Auth\RegisterComponent;
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


// Route::group(function () {

// })->middleware('admin');
Route::group(['middleware' => 'auth:admin'], function () {

   Route::get('/admin/dashboard', DashboardComponent::class)->name('admin.dashboard');

   Route::get('/admin/dosen', DosenComponent::class);

   Route::get('/admin/buku', BukuComponent::class);
   Route::get('/admin/buku/detail/{id}', DetailBuku::class);

   Route::get('/admin/skripsi', SkripsiComponent::class);
   Route::get('/admin/skripsi/detail/{id}', DetailSkripsi::class);

   Route::get('/admin/kp', KpComponent::class);
   Route::get('/admin/kp/detail/{id}', DetailKp::class);
});




Route::get('/', [PublicController::class, 'getCountTable'])->name('home');
Route::get('/buku/', [PublicController::class, 'indexBuku']);
Route::get('/buku/detail/{id}', [PublicController::class, 'showBuku']);

//skripsi
Route::get('/skripsi', [PublicController::class, 'indexSkripsi']);
Route::get('/skripsi/detail/{id}', [PublicController::class, 'showSkripsi']);

//kp
Route::get('/kp', [PublicController::class, 'indexKp']);
Route::get('/kp/detail/{id}', [PublicController::class, 'showKp']);

//Pencarian
Route::get('search/', [PublicController::class, 'search']);
Route::get('{category}/{filter}/search', [PublicController::class, 'searchCategory'])
   ->name('search.category');

Route::redirect('/pustaka_lainnya', '/buku');



// auth

Route::middleware('guest:web')->group(function () {
   Route::get('/login', LoginComponent::class)->name('login');
   Route::get('/register', RegisterComponent::class)->name('register');
});

Route::middleware('guest:admin')->group(function () {
   Route::get('/admin/login', AdminLoginComponent::class)->name('admin.login');
   Route::get('/admin/register', AdminRegisterComponent::class)->name('admin.register');

});

Route::get('/logout', [PublicController::class, 'logout'])->name('logout');
Route::get('/admin/logout', [Index::class, 'logout'])->name('admin.logout');

// Route::get('/register', Register::class);
