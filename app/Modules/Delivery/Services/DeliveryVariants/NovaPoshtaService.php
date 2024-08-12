<?php

namespace App\Modules\Delivery\Services\DeliveryVariants;

use Illuminate\Support\Facades\Http;

class NovaPoshtaService implements CourierServiceInterface
{
    public function send(array $parcelData): bool
    {
        $response = Http::post(config('app.api_nova_poshta_url'), $parcelData);

        return $response->successful();
    }

    public function getDeliveryData(array $validatedData): array
    {
        return [
            'customer_name' => $validatedData['customer_name'],
            'phone_number' => $validatedData['phone_number'],
            'email' => $validatedData['email'],
            'адреса_відправника' => config('app.sender_address'),
            'адреса_доставки' => $validatedData['delivery_address'],
            'parcel' => [
                'width' => $validatedData['width'],
                'height' => $validatedData['height'],
                'length' => $validatedData['length'],
                'weight' => $validatedData['weight'],
            ]
        ];
    }
}
