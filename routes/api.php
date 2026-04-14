<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

// Webhook untuk Manager
Route::post('/wijayapay/manager/notification', [RegisterController::class, 'wijayapayNotification']);

Route::get('/check-manager-payment/{invoice}', function($invoice) {
    $status = \App\Models\Manager::where('invoice_number', $invoice)->value('payment_status');
    return response()->json(['status' => $status]);
});