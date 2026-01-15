<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\JobOrderController;
use App\Http\Controllers\DeliveryReceiptController;
use App\Http\Controllers\SimpleSearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home.index');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('banks', BankController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('positions', PositionController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('items', ItemController::class);
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('quotations', QuotationController::class);
    Route::resource('job-orders', JobOrderController::class);
    Route::resource('delivery-receipts', DeliveryReceiptController::class);

    // PDF routes (existing)
    Route::get('quotations/{id}/pdf/download', [QuotationController::class, 'downloadPdf'])->name('quotations.pdf.download');
    Route::get('quotations/{id}/pdf/preview', [QuotationController::class, 'previewPdf'])->name('quotations.pdf.preview');
    Route::get('delivery-receipts/{id}/pdf/preview', [DeliveryReceiptController::class, 'previewPdf'])->name('delivery-receipts.pdf.preview');
    Route::get('delivery-receipts/{id}/pdf/download', [DeliveryReceiptController::class, 'downloadPdf'])->name('delivery-receipts.pdf.download');

    // Simple Search PDF routes (harus sebelum resource)
    Route::get('simple-searches/export/pdf', [SimpleSearchController::class, 'exportPdf'])->name('simple-searches.export.pdf');
    Route::get('simple-searches/{id}/pdf/preview', [SimpleSearchController::class, 'previewPdf'])->name('simple-searches.pdf.preview');
    Route::get('simple-searches/{id}/pdf/download', [SimpleSearchController::class, 'downloadPdf'])->name('simple-searches.pdf.download');
    Route::resource('simple-searches', SimpleSearchController::class);
       
});

require __DIR__ . '/auth.php';
