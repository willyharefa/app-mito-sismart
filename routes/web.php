<?php

use App\Http\Controllers\Activity\DealController;
use App\Http\Controllers\Activity\IntroductionController;
use App\Http\Controllers\Activity\JartestController;
use App\Http\Controllers\Activity\MappingController;
use App\Http\Controllers\Activity\NegotiationController;
use App\Http\Controllers\Activity\PenetrationController;
use App\Http\Controllers\Activity\QuotationController;
use App\Http\Controllers\Activity\QuotationItemController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Partner\CustomerController;
use App\Http\Controllers\Partner\VendorController;
use App\Http\Controllers\Project\ProspectController;
use App\Http\Controllers\Setting\BranchController;
use App\Http\Controllers\Setting\TypeCustomerController;
use App\Http\Controllers\Setting\TypeProgressController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\Transaction\PoInternalController;
use App\Http\Controllers\Transaction\SppbController;
use App\Models\Inventory\Stock;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('components.app.layouts');
});

Route::resource('stocks', StockController::class);
Route::resource('customer', CustomerController::class);
Route::resource('vendor', VendorController::class);
Route::resource('branch', BranchController::class);
Route::resource('type-customer', TypeCustomerController::class);
Route::resource('type-progress', TypeProgressController::class);
Route::resource('sppb', SppbController::class);
Route::resource('po-internal', PoInternalController::class);
Route::resource('prospect', ProspectController::class);
Route::resource('mapping', MappingController::class);
Route::resource('introduction', IntroductionController::class);
Route::resource('penetration', PenetrationController::class);
Route::resource('jartest', JartestController::class);
Route::resource('quotation', QuotationController::class);
Route::put('/quotation-status/{quotationId}', [QuotationController::class, 'updateStatusQuotation'])->name('updateStatusQuotation');


Route::resource('quotation-item', QuotationItemController::class);
Route::get('/quotation-item/{quotationId}/show', [QuotationItemController::class, 'showItemsQuotation'])->name('showItemsQuotation');

Route::resource('negotiation', NegotiationController::class);
Route::resource('deal', DealController::class);


Route::get('/product/{id}', [Controller::class, 'getProductId'])->name('getProductId');
Route::get('/quotation/{id}/show', [Controller::class, 'getIdProspect'])->name('getIdProspect');
