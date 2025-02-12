<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('lang/{locale}', [LangController::class, 'setLocale'])->name('setLocale');
Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy.policy');

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/outh', function () {
    return view('outh');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/branches/store', [BranchController::class, 'store'])->name('branches.store');
    Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
    Route::get('/branches/list', [BranchController::class, 'list'])->name('branches.list');
    Route::get('/branches/{id}', [BranchController::class, 'show'])->name('branches.show');

    // Automatically generates routes for index, create, store, edit, update, and destroy
    Route::resource('sectionList', SectionController::class);

    Route::resource('members', MemberController::class);

    Route::get('/requests/create', [RequestController::class, 'create'])->name('requests.create');

    Route::post('/requests/store', [RequestController::class, 'store'])->name('requests.store');
    Route::post('/sectionList/{id}/setDefault', [SectionController::class, 'setDefaultSection'])->name('sectionList.setDefault');
    // Routes in web.php
    Route::post('/members/status/update', [MemberController::class, 'updateStatus'])->name('members.status.update');


});

// Remove conflicting sections route
// Route::get('/sections', function () {
//     return view('/sections');
// });

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

// Route::get('/members', function () {
//     return view('/members');
// });

Route::get('/letters', function () {
    return view('/letters');
});

Route::get('/reports', function () {
    return view('/reports');
});

Route::get('/profile', function () {
    return view('/profile');
});

Route::get('/reports_all', function () {
    return view('/reports_all');
});

Route::get('/reports_detail', function () {
    return view('/reports_detail');
});

Route::get('/compare_single', function () {
    return view('/compare_single');
});
