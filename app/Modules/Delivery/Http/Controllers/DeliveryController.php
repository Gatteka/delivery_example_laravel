<?php

namespace App\Modules\Delivery\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Delivery\Services\DeliveryVariants\CourierServiceInterface;
use App\Modules\Delivery\Services\DeliveryVariants\Factory\CourierServiceFactory;


class DeliveryController extends Controller
{
    protected $courierService;

    public function sendDeliveryData(Request $request)
    {

        // 
        // I assume more checking logic should be also provided 
        // we can't trust request data easily in any case
        //
        $type = $this->checkDeliveryType($request->courier);

        // add dynamic courier factory
        $this->courierService = CourierServiceFactory::make($type);

        // may be moved to dedicated validation file
        // to simplify controller
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'delivery_address' => 'required|string|max:255',
            'width' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:1',
            'length' => 'required|numeric|min:1',
            'weight' => 'required|numeric|min:0.1',
            'courier' => 'required|string',
        ]);

        // aditional logging logic may be added here
        if ($this->courierService->send($this->courierService->getDeliveryData($validatedData))) {
            return response()->json(['message' => 'Success.'], 200);
        } else {
            return response()->json(['error' => 'Error. Try later.'], 500);
        }
    }


    public function checkDeliveryType(string $type): string
    {
        //logic for aditional validation of request data if needed
        // i will just return type for now
        return $type;
    }
}