<?php

namespace App;

class Constants
{
    public static function getUserStatusOptions()
    {
        return [
            'active',
            'inactive'
        ];
    }

    public static function getUserStatusDefault()
    {
        return 'active';
    }

    public static function getProductStatusOptions()
    {
        return [
            'available',
            'unavailable'
        ];
    }

    public static function getProductStatusDefault()
    {
        return 'available';
    }
    public static function getOrderStatusOptions()
    {
        return [
            'confirmed',
            'unconfirmed',
            'pending',
        ];
    }
    public static function getOrderStatusDefault()
    {
        return 'unconfirmed';
    }
}
