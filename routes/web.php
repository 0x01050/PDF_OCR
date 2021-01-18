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
    return view('pdf.scan');
})->name('home');
Route::get('/borrower-docusign', function () {
    return view('pdf.borrower');
})->name('borowwer');
Route::get('/smartapp-1003', function () {
    return view('smartapp.admin');
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
    Route::post('/updateField/{id}', ['as' => 'update', 'uses' => 'App\Http\Controllers\SmartAppController@updateField']);

    Route::get('/edit/{id}/start', ['as' => 'start', 'uses' => 'App\Http\Controllers\SmartAppController@startApp']);

    Route::get('/edit/{id}/borrower/info', ['as' => 'borrower.info', 'uses' => 'App\Http\Controllers\SmartAppController@borrowerInfo']);
    Route::get('/edit/{id}/borrower/address', ['as' => 'borrower.address', 'uses' => 'App\Http\Controllers\SmartAppController@borrowerAddress']);
    Route::get('/edit/{id}/borrower/employment', ['as' => 'borrower.employment', 'uses' => 'App\Http\Controllers\SmartAppController@borrowerEmployment']);
    Route::get('/edit/{id}/borrower/employment/edit/{emp_id}', ['as' => 'borrower.employment.edit', 'uses' => 'App\Http\Controllers\SmartAppController@borrowerEmploymentEdit']);
    Route::get('/edit/{id}/borrower/employment/remove/{emp_id}', ['as' => 'borrower.employment.remove', 'uses' => 'App\Http\Controllers\SmartAppController@borrowerEmploymentRemove']);
    Route::get('/edit/{id}/borrower/income', ['as' => 'borrower.income', 'uses' => 'App\Http\Controllers\SmartAppController@borrowerIncome']);

    Route::get('/edit/{id}/coborrower/info', ['as' => 'coborrower.info', 'uses' => 'App\Http\Controllers\SmartAppController@coborrowerInfo']);
    Route::get('/edit/{id}/coborrower/address', ['as' => 'coborrower.address', 'uses' => 'App\Http\Controllers\SmartAppController@coborrowerAddress']);
    Route::get('/edit/{id}/coborrower/employment', ['as' => 'coborrower.employment', 'uses' => 'App\Http\Controllers\SmartAppController@coborrowerEmployment']);
    Route::get('/edit/{id}/coborrower/employment/edit/{emp_id}', ['as' => 'coborrower.employment.edit', 'uses' => 'App\Http\Controllers\SmartAppController@coborrowerEmploymentEdit']);
    Route::get('/edit/{id}/coborrower/employment/remove/{emp_id}', ['as' => 'coborrower.employment.remove', 'uses' => 'App\Http\Controllers\SmartAppController@coborrowerEmploymentRemove']);
    Route::get('/edit/{id}/coborrower/income', ['as' => 'coborrower.income', 'uses' => 'App\Http\Controllers\SmartAppController@coborrowerIncome']);

    Route::get('/edit/{id}/property/loan', ['as' => 'property.loan', 'uses' => 'App\Http\Controllers\SmartAppController@propertyLoan']);
    Route::get('/edit/{id}/property/purpose', ['as' => 'property.purpose', 'uses' => 'App\Http\Controllers\SmartAppController@propertyPurpose']);

    Route::get('/edit/{id}/financial/liquid', ['as' => 'financial.liquid', 'uses' => 'App\Http\Controllers\SmartAppController@financialLiquid']);
    Route::get('/edit/{id}/financial/liquid/edit/{liq_id}', ['as' => 'financial.liquid.edit', 'uses' => 'App\Http\Controllers\SmartAppController@financialLiquidEdit']);
    Route::get('/edit/{id}/financial/liquid/remove/{liq_id}', ['as' => 'financial.liquid.remove', 'uses' => 'App\Http\Controllers\SmartAppController@financialLiquidRemove']);
    Route::get('/edit/{id}/financial/combined', ['as' => 'financial.combined', 'uses' => 'App\Http\Controllers\SmartAppController@financialCombined']);
    Route::get('/edit/{id}/financial/autos', ['as' => 'financial.autos', 'uses' => 'App\Http\Controllers\SmartAppController@financialAutos']);
    Route::get('/edit/{id}/financial/autos/edit/{aut_id}', ['as' => 'financial.autos.edit', 'uses' => 'App\Http\Controllers\SmartAppController@financialAutosEdit']);
    Route::get('/edit/{id}/financial/autos/remove/{aut_id}', ['as' => 'financial.autos.remove', 'uses' => 'App\Http\Controllers\SmartAppController@financialAutosRemove']);
    Route::get('/edit/{id}/financial/estate', ['as' => 'financial.estate', 'uses' => 'App\Http\Controllers\SmartAppController@financialEstate']);
    Route::get('/edit/{id}/financial/estate/edit/{est_id}', ['as' => 'financial.estate.edit', 'uses' => 'App\Http\Controllers\SmartAppController@financialEstateEdit']);
    Route::get('/edit/{id}/financial/estate/remove/{est_id}', ['as' => 'financial.estate.remove', 'uses' => 'App\Http\Controllers\SmartAppController@financialEstateRemove']);
    Route::get('/edit/{id}/financial/other', ['as' => 'financial.other', 'uses' => 'App\Http\Controllers\SmartAppController@financialOther']);
    Route::get('/edit/{id}/financial/other/edit/{oth_id}', ['as' => 'financial.other.edit', 'uses' => 'App\Http\Controllers\SmartAppController@financialOtherEdit']);
    Route::get('/edit/{id}/financial/other/remove/{oth_id}', ['as' => 'financial.other.remove', 'uses' => 'App\Http\Controllers\SmartAppController@financialOtherRemove']);

    Route::get('/edit/{id}/disclosures/borrower', ['as' => 'disclosures.borrower', 'uses' => 'App\Http\Controllers\SmartAppController@disclosuresBorrower']);
    Route::get('/edit/{id}/disclosures/coborrower', ['as' => 'disclosures.coborrower', 'uses' => 'App\Http\Controllers\SmartAppController@disclosuresCoborrower']);
    Route::get('/edit/{id}/disclosures/demographic', ['as' => 'disclosures.demographic', 'uses' => 'App\Http\Controllers\SmartAppController@disclosuresDemographic']);

    Route::get('/edit/{id}/finish', ['as' => 'finish', 'uses' => 'App\Http\Controllers\SmartAppController@finishApp']);
});
