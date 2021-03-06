<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/', 'DashboardController@getDashboard');

Route::get('performance_budget', 'PerformanceBudgetController@getPerformanceBudget');
Route::get('performance_budget/datatables', 'PerformanceBudgetController@getDatatables');
Route::get('performance_budget/add', 'PerformanceBudgetController@getAdd');
Route::post('performance_budget/add', 'PerformanceBudgetController@doAdd');
Route::get('performance_budget/edit/{id?}', 'PerformanceBudgetController@getAdd');
Route::post('performance_budget/edit/{id?}', 'PerformanceBudgetController@doAdd');
Route::get('performance_budget/detail/{id?}', 'PerformanceBudgetController@getDetail');
Route::post('performance_budget/detail/{id?}', 'PerformanceBudgetController@doDetail');
Route::get('performance_budget/delete/{id?}', 'PerformanceBudgetController@doDelete');
Route::get('performance_budget/detail/delete/{id?}', 'PerformanceBudgetController@doDetailDelete');
Route::get('performance_budget/detail/datatables/{id?}', 'PerformanceBudgetController@getDetailDatatables');

Route::get('purchase_order', 'PurchaseOrderController@getPurchaseOrder');
Route::get('purchase_order/datatables', 'PurchaseOrderController@getDatatables');
Route::get('purchase_order/add', 'PurchaseOrderController@getAdd');
Route::post('purchase_order/add', 'PurchaseOrderController@doAdd');
Route::get('purchase_order/edit/{id?}', 'PurchaseOrderController@getAdd');
Route::post('purchase_order/edit/{id?}', 'PurchaseOrderController@doAdd');
Route::get('purchase_order/delete/{id?}', 'PurchaseOrderController@doDelete');
Route::get('purchase_order/detail/{id?}', 'PurchaseOrderController@getDetail');
Route::post('purchase_order/detail/{id?}', 'PurchaseOrderController@doDetail');
Route::get('purchase_order/detail/edit/{po_id?}/{po_detail_id?}', 'PurchaseOrderController@getDetail');
Route::post('purchase_order/detail/edit/{po_id?}/{po_detail_id?}', 'PurchaseOrderController@doDetail');
Route::get('purchase_order/detail/delete/{po_detail_id?}', 'PurchaseOrderController@doDetailDelete');
Route::get('purchase_order/detail/export/{id?}', 'PurchaseOrderController@exportExcel');

Route::get('invoice', 'InvoiceController@getInvoice');
Route::get('invoice/datatables', 'InvoiceController@getDatatables');
Route::get('invoice/add', 'InvoiceController@getAdd');
Route::post('invoice/add', 'InvoiceController@doAdd');
Route::get('invoice/edit/{id?}', 'InvoiceController@getAdd');
Route::post('invoice/edit/{id?}', 'InvoiceController@doAdd');
Route::get('invoice/delete/{id?}', 'InvoiceController@doDelete');
Route::get('invoice/detail/{id?}', 'InvoiceController@getDetail');
Route::post('invoice/detail/{id?}', 'InvoiceController@doDetail');
Route::get('invoice/detail/edit/{po_id?}/{po_detail_id?}', 'InvoiceController@getDetail');
Route::post('invoice/detail/edit/{po_id?}/{po_detail_id?}', 'InvoiceController@doDetail');
Route::get('invoice/detail/delete/{po_detail_id?}', 'InvoiceController@doDetailDelete');
Route::get('invoice/detail/export/{id?}', 'InvoiceController@exportExcel');
Route::get('invoice/nom/{id?}', 'InvoiceController@getNom');

Route::get('pembayaran', 'PembayaranController@getPembayaran');
Route::get('pembayaran/datatables', 'PembayaranController@getDatatables');
Route::get('pembayaran/add', 'PembayaranController@getAdd');
Route::post('pembayaran/add', 'PembayaranController@doAdd');
Route::get('pembayaran/edit/{id?}', 'PembayaranController@getAdd');
Route::post('pembayaran/edit/{id?}', 'PembayaranController@doAdd');
Route::get('pembayaran/delete/{id?}', 'PembayaranController@doDelete');

Route::get('realisasi', 'RealisasiController@getPerformanceBudget');
Route::get('realisasi/datatables', 'RealisasiController@getDatatables');
Route::get('realisasi/detail/{id?}', 'RealisasiController@getDetail');
Route::get('realisasi/download/{id?}/{view?}', 'RealisasiController@downloadPdf');
// Route::get('realisasi/detail/datatables/{id?}', 'RealisasiController@getDetailDatatables');

Route::get('advance_payment', 'AdvancePaymentController@getAdvancePayment');
Route::get('advance_payment/datatables', 'AdvancePaymentController@getDatatables');
Route::get('advance_payment/detail/{id?}', 'AdvancePaymentController@getDetail');
Route::get('advance_payment/add', 'AdvancePaymentController@getAdd');
Route::post('advance_payment/add', 'AdvancePaymentController@doAdd');
Route::get('advance_payment/edit/{id?}', 'AdvancePaymentController@getAdd');
Route::post('advance_payment/edit/{id?}', 'AdvancePaymentController@doAdd');
Route::get('advance_payment/delete/{id?}', 'AdvancePaymentController@doDelete');
Route::post('advance_payment/confirm/{id?}', 'AdvancePaymentController@doConfirm');
