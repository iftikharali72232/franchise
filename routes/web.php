<?php

use App\Http\Controllers\Api\RequestController as ApiRequestController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\ProfileController;

Route::get('lang/{locale}', [LangController::class, 'setLocale'])->name('setLocale');

Route::get('/about-us', [PageController::class, 'aboutUs']);
Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/contact-us', [PageController::class, 'contactUs'])->name('contact.us');
Route::post('/contact-us', [PageController::class, 'submitContactForm'])->name('contact.submit');

Route::get('/', function () {
    return redirect()->route('home');
});
Route::get('/report_view/{id}', [ReportController::class, 'report_view'])->name('report_view');

Route::get('/outh', function () {
    return view('outh');
});
Route::get('/generate-pdf', [PdfController::class, 'generatePdf']);
Route::post('/generate-current-page-pdf', [PdfController::class, 'generateCurrentPagePdf'])->name('generate.current.page.pdf');
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/branches/create', [BranchController::class, 'create'])->name('branches.create'); // Move this above {id} route
    Route::post('/branches/store', [BranchController::class, 'store'])->name('branches.store');
    Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
    Route::get('/branches/list', [BranchController::class, 'list'])->name('branches.list');
    Route::get('/branches/{id}', [BranchController::class, 'show'])->name('branches.show'); // Keep this last

    Route::get('/admin/contact-messages', [PageController::class, 'viewMessages'])->name('contact.messages');

    // Automatically generates routes for index, create, store, edit, update, and destroy
    Route::resource('sectionList', SectionController::class);

    Route::resource('members', MemberController::class);

    Route::get('/requests/create', [RequestController::class, 'create'])->name('requests.create');

    Route::post('/requests/store', [RequestController::class, 'store'])->name('requests.store');
    Route::post('/sectionList/{id}/setDefault', [SectionController::class, 'setDefaultSection'])->name('sectionList.setDefault');
    // Routes in web.php
    Route::post('/members/status/update', [MemberController::class, 'updateStatus'])->name('members.status.update');
    Route::get('/generate-code', [RequestController::class, 'generateCode']);
    Route::post('/get-questions', [RequestController::class, 'getQuestions']);
    Route::get('/reports/all', [ReportController::class, 'index'])->name('reports_all');
    Route::get('/report_detail/{id}', [ReportController::class, 'show'])->name('report_detail');

    Route::post('/generate-pdf', [ReportController::class, 'generatePdf'])->name('generate-pdf');
    Route::post('/send-report', [ReportController::class, 'sendReport'])->name('send-report');
    Route::post('/send-report-watsapp', [ReportController::class, 'sendWhatsappReport'])->name('send-report-watsapp');

   
    Route::get('/letters', [LetterController::class, 'index'])->name('letters.index');
    Route::get('/letters/create', [LetterController::class, 'create'])->name('letters.create');
    Route::post('/letters/send', [LetterController::class, 'send'])->name('letters.send');
    Route::get('/letters/{letter}', [LetterController::class, 'show'])->name('letters.show');

    Route::get('/branches/{id}/edit', [BranchController::class, 'edit'])->name('branches.edit');
Route::put('/branches/{id}', [BranchController::class, 'update'])->name('branches.update');
Route::post('/delete-attachment', [ReportController::class, 'deleteAdminImage']);
Route::post('/save-admin-data', [ReportController::class, 'saveAdminData']);
Route::post('/update-admin-note', [ReportController::class, 'updateAdminNote'])->name('update.admin.note');

Route::post('/upload-admin-images', [ReportController::class, 'uploadAdminImages']);

Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

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

// Route::get('/letters', function () {
//     return view('/letters');
// });

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
