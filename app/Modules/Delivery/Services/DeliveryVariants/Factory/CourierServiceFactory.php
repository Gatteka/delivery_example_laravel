<?php

namespace App\Modules\Delivery\Services\DeliveryVariants\Factory;

use App\Modules\Delivery\Services\DeliveryVariants\CourierServiceInterface;
use App\Modules\Delivery\Services\DeliveryVariants\NovaPoshtaService;
use App\Modules\Delivery\Services\DeliveryVariants\UkrPoshtaService;

class CourierServiceFactory
{
    public static function make(string $courier): CourierServiceInterface
    {
        return match($courier) {
            'nova_poshta' => new NovaPoshtaService(),
            'ukr_poshta' => new UkrPoshtaService(),
            // Another couriers may be add here
            default => throw new \InvalidArgumentException("Unsupported courier: $courier"),
        };
    }
}
