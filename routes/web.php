<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\PemilihanController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PaxController;
use App\Http\Controllers\PaxExport;
use Maatwebsite\Excel\Facades\Excel;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/blank', function () {
    return view('blank');
})->name('blank');
Route::get('/google/login', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/google/callback', [GoogleController::class, 'handleCallback'])->name('google.callback');

Route::get('/pax/export', function (Request $request) {
    return Excel::download(new PaxExport($request->tanggal), 'data-pax.xlsx');
})->name('pax.export');


Route::middleware('auth')->group(function() {
    Route::resource('basic', BasicController::class);
    Route::resource('pax', PaxController::class);
    Route::patch('/pax/update-respon-pnr/{id}', [PaxController::class, 'updateResponPnr'])->name('pax.update_respon_pnr');

    Route::resource('pemilihan', PemilihanController::class);
    Route::resource('hasilpemilihan', HasilPemilihanController::class);

    Route::put('/basic/{id}/pemilih', [BasicController::class, 'pemilih'])->name('basic.pemilih');
    Route::put('/basic/{id}/kesiswaan', [BasicController::class, 'kesiswaan'])->name('basic.kesiswaan');
    
});

