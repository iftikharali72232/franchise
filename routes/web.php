<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LangController;

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
// Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('lang/{locale}', [LangController::class, 'setLocale'])->name('setLocale');
Route::get('/', function () {
    return redirect()->route('home');
});
// routes/web.php

Route::get('/outh', function () {
    return view('outh');
});
Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


