<?php

namespace App\Modules\Delivery\Services\DeliveryVariants;

interface CourierServiceInterface
{
    public function send(array $parcelData): bool;

    public function getDeliveryData(array $data): array;
}
