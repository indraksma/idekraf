<?php

use App\Models\Usaha;

if (!function_exists('getUnverifiedCount')) {
    function getUnverifiedCount()
    {
        return Usaha::where('isVerified', false)->count();
    }
}
