<?php

use App\Http\Livewire\BukuComponent;
use App\Http\Livewire\DosenComponent;
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


Route::get('/admin/dosen', DosenComponent::class);
Route::get('/admin/buku', BukuComponent::class);
