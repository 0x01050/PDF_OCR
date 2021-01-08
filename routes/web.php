<?php

use Illuminate\Support\Facades\Response;
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

Route::get('/', function () {
    return view('scan');
})->name('home');
Route::get('/borrower-docusign', function () {
    return view('borrower');
})->name('borowwer');
Route::get('/smartapp-1033', function () {
    return view('smartapp');
})->name('smartapp');

Route::post('/import', ['as' => 'import', 'uses' => 'App\Http\Controllers\OCRController@scan']);
Route::post('/borrower-import', ['as' => 'borrower-import', 'uses' => 'App\Http\Controllers\OCRController@borrowerScan']);

Route::get('files/{file_name}', function($file_name = null)
{
    $path = storage_path('app/' . $file_name . '.zip');
    if (file_exists($path)) {
        return Response::download($path);
    }
});

Route::prefix('smartapp')->name('smartapp.')->group(function () {
    Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'App\Http\Controllers\SmartAppController@editApp']);
    Route::get('/pdf/{id}', ['as' => 'pdf', 'uses' => 'App\Http\Controllers\SmartAppController@exportPDF']);
    Route::get('/fnm/{id}', ['as' => 'fnm', 'uses' => 'App\Http\Controllers\SmartAppController@exportFNM']);

    Route::get('/get', ['as' => 'get', 'uses' => 'App\Http\Controllers\SmartAppController@getApps']);
});
