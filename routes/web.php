<?php

use App\Http\Controllers\BranchController;
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
    Route::post('/branches/store', [BranchController::class, 'store'])->name('branches.store');
    Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
    Route::get('/branches/list', [BranchController::class, 'list'])->name('branches.list');
    Route::get('/branches/{id}', [BranchController::class, 'show'])->name('branches.show');


});

Route::get('/login2', function () {
    return view('/auth/login2');
});

Route::get('/register2', function () {
    return view('/auth/register2');
});

Route::get('/otp', function () {
    return view('/auth/otp');
});

Route::get('/forgot_password', function () {
    return view('/auth/forgot_password');
});


Route::get('/reset_password', function () {
    return view('/auth/reset_password');
});

// Route::get('/branches', function () {
//     return view('/branches');
// });

Route::get('/members', function () {
    return view('/members');
});

Route::get('/letters', function () {
    return view('/letters');
});

Route::get('/reports', function () {
    return view('/reports');
});

Route::get('/profile', function () {
    return view('/profile');
});

Route::get('/sections', function () {
    return view('/sections');
});

Route::get('/reports_all', function () {
    return view('/reports_all');
});

Route::get('/reports_detail', function () {
    return view('/reports_detail');
});