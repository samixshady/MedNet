<?php

namespace App\Helpers;

class DeliveryHelper
{
    /**
     * Get estimated delivery days based on delivery option
     */
    public static function getDeliveryDays($deliveryOption)
    {
        return match($deliveryOption) {
            'express' => ['min' => 1, 'max' => 2],
            'overnight' => ['min' => 1, 'max' => 1],
            'standard' => ['min' => 3, 'max' => 5],
            default => ['min' => 3, 'max' => 5],
        };
    }

    /**
     * Get human readable delivery estimate
     */
    public static function getDeliveryEstimate($deliveryOption)
    {
        return match($deliveryOption) {
            'express' => '1-2 business days',
            'overnight' => 'Next business day',
            'standard' => '3-5 business days',
            default => '3-5 business days',
        };
    }

    /**
     * Get estimated delivery dates
     */
    public static function getEstimatedDateRange($createdDate, $deliveryOption)
    {
        $days = self::getDeliveryDays($deliveryOption);
        $minDate = $createdDate->addDays($days['min']);
        $maxDate = $createdDate->copy()->addDays($days['max']);
        
        return [
            'min' => $minDate,
            'max' => $maxDate,
        ];
    }
}
