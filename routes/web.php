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
});

Route::post('/import', ['as' => 'import', 'uses' => 'App\Http\Controllers\OCRController@scan']);

Route::get('files/{file_name}', function($file_name = null)
{
    $path = storage_path('app/' . $file_name . '.zip');
    if (file_exists($path)) {
        return Response::download($path);
    }
});
