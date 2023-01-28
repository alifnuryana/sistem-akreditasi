<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\DocumentsSubsController;
use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\SubsController;
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

Route::permanentRedirect('/', '/login');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', DashboardController::class)
        ->name('dashboard');

    Route::resource('/standar', DocumentsController::class, [
        'names' => [
            'create' => 'documents.create',
            'store' => 'documents.store',
            'index' => 'documents.index',
        ],
    ])->only('create', 'store', 'index');

    Route::get('/standar/{standard}/sub', [DocumentsSubsController::class, 'index'])
        ->whereNumber('standard')
        ->name('documents.subs.index');

    Route::get('/standar/{standard}/sub/{sub}', [DocumentsSubsController::class, 'show'])
        ->name('documents.subs.show');

    Route::delete('/standar/sub/{document}', [DocumentsSubsController::class, 'destroy'])
        ->name('documents.subs.destroy');

    Route::get('/download/{id}', DownloadsController::class)
        ->whereNumber('id')
        ->name('download');

});
