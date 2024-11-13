<?php

use App\Models\Setting;
use App\Models\Usaha;

if (!function_exists('getUnverifiedCount')) {
    function getUnverifiedCount()
    {
        return Usaha::where('isVerified', false)->count();
    }
}
if (!function_exists('getTwitter')) {
    function getTwitter()
    {
        $tt = Setting::where('name', 'twitter')->first();
        if ($tt) {
            if ($tt->value != NULL) {
                return $tt->value;
            } else {
                $link = 'https://twitter.com/';
                return $link;
            }
        } else {
            $link = 'https://twitter.com/';
            return $link;
        }
    }
}
if (!function_exists('getYoutube')) {
    function getYoutube()
    {
        $yt = Setting::where('name', 'youtube')->first();
        if ($yt) {
            if ($yt->value != NULL) {
                return $yt->value;
            } else {
                $link = 'https://youtube.com/';
                return $link;
            }
        } else {
        }
    }
}
if (!function_exists('getInstagram')) {
    function getInstagram()
    {
        $ig = Setting::where('name', 'instagram')->first();
        if ($ig) {
            if ($ig->value != NULL) {
                return $ig->value;
            } else {
                $link = 'https://instagram.com/';
                return $link;
            }
        } else {
            $link = 'https://instagram.com/';
            return $link;
        }
    }
}
if (!function_exists('getFacebook')) {
    function getFacebook()
    {
        $fb = Setting::where('name', 'facebook')->first();
        if ($fb) {
            if ($fb->value != NULL) {
                return $fb->value;
            } else {
                $link = 'https://facebook.com/';
                return $link;
            }
        } else {
            $link = 'https://facebook.com/';
            return $link;
        }
    }
}
