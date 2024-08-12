<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Delivery\Http\Controllers\DeliveryController;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/send-delivery-data', [DeliveryController::class, 'sendDeliveryData']);


