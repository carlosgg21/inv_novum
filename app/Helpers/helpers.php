<?php

use App\Models\Setting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;



if (!function_exists('format_money')) {
    function format_money($value, $currency = 'USD')
    {
        $currencies = [
            'USD' => '$',
            'GBP' => '£',
            'EUR' => '€',
            'JPY' => '¥',
            'RUB' => '₽',
            'BRL' => 'R$',
        ];

        return array_key_exists($currency, $currencies)
            ? $currencies[$currency].number_format($value, 2)
            : '$'.number_format($value, 2);
    }
}

if (!function_exists('today_date')) {
    function today_date($format = 'm/d/Y')
    {
        return Carbon::now()->format($format);
    }
}

if (!function_exists('today_now')) {
    function today_now($format = 'Y-m-d H:i:s')
    {
        return !$format ? Carbon::now() : Carbon::now()->format($format);
    }
}

if (!function_exists('setting')) {
    /**
     * Undocumented function
     *
     * @param [type] $key
     * @param [type] $default
     * @return void
     */
    function setting($key, $default = null)
    {
        $parts = explode('.', $key);

        if (count($parts) !== 2) {
            throw new InvalidArgumentException("The setting key must be in the format 'group.name'. Given: {$key}");
        }

        list($group, $name) = $parts;

        return Cache::rememberForever("setting_{$group}_{$name}", function () use ($group, $name, $default) {
            $setting = Setting::where('group', $group)->where('name', $name)->first();

            return $setting ? $setting->value : $default;
        });
    }

    
if (!function_exists('format_date')) {
    function format_date($date, $format = 'Y-m-d')
    {
        return $date ? date($format, strtotime($date)) : '';
    }
}

}
