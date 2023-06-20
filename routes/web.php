<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\UserController;

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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('qrcode', [App\Http\Controllers\QrCodeController::class, 'index'])->name('qrcode');
Route::get('qrscan', [App\Http\Controllers\QrCodeController::class, 'scan'])->name('qrscan');
Route::post('qrresults', [App\Http\Controllers\QrCodeController::class, 'results'])->name('qrresults');
Route::get('qrscanned', [App\Http\Controllers\QrCodeController::class, 'scanned'])->name('qrscanned');
Route::get('qrsuccess', [App\Http\Controllers\QrCodeController::class, 'success'])->name('qrsuccess');
Route::get('qrfailed', [App\Http\Controllers\QrCodeController::class, 'failed'])->name('qrfailed');
Route::get('qrpersonal', [App\Http\Controllers\QrCodeController::class, 'personal'])->name('qrpersonal');
Route::get('qrpersonal2', [App\Http\Controllers\QrCodeController::class, 'personal'])->name('qrpersonal2');
Route::post('qrattend', [App\Http\Controllers\QrCodeController::class, 'attend'])->name('qrattend');
Route::get('timetable', [App\Http\Controllers\QrCodeController::class, 'timetable'])->name('timetable');
Route::get('attendees', [App\Http\Controllers\QrCodeController::class, 'attendees'])->name('attendees');
Route::get('qrterms', [App\Http\Controllers\QrCodeController::class, 'terms'])->name('qrterms');
Route::get('qrtermsconfirm', [App\Http\Controllers\QrCodeController::class, 'termsconfirm'])->name('qrtermsconfirm');


Route::get('file-import',[UserController::class, 'importView'])->name('import-view');
Route::post('import',[UserController::class, 'import'])->name('import');
Route::get('export',[UserController::class, 'exportUsers'])->name('export');


