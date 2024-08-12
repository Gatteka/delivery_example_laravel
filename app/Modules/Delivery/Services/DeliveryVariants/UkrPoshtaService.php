<?php

namespace App\Modules\Delivery\Services\DeliveryVariants;

use Illuminate\Support\Facades\Http;

class UkrPoshtaService implements CourierServiceInterface
{
    public function send(array $parcelData): bool
    {
        $response = Http::post(config('app.api_ukrposhta_url'), $parcelData);

        return $response->successful();
    }

    public function getDeliveryData(array $validatedData): array
    {
        return [
            // data variant for this courier
        ];
        
    }
}
