<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NomodService
{
    protected static $apiKey;
    protected static $baseUrl;

    protected static function init()
    {
        self::$apiKey  = config('services.nomod.key');  
        self::$baseUrl = config('services.nomod.base_url', 'https://api.nomod.com/v1');
    }

    /**
     * Create a checkout session
     *
     * @param array $data
     * @return array
     */
    public static function createCheckout(array $data)
    {
        self::init();

        // Log request
        Log::channel('nomod')->info('Nomod Checkout Request', $data);

        $response = Http::withHeaders([
            'X-API-KEY' => self::$apiKey,
            'Accept'    => 'application/json',
        ])->post(self::$baseUrl . '/checkout', $data);

        $responseData = $response->json();

        // Log response
        Log::channel('nomod')->info('Nomod Checkout Response', $responseData);

        return $responseData;
    }

    /**
     * Get checkout session details
     *
     * @param string $checkoutId
     * @return array
     */
    public static function getCheckout(string $checkoutId)
    {
        self::init();

        // Log request
        Log::channel('nomod')->info('Nomod Get Checkout Request', ['checkout_id' => $checkoutId]);

        $response = Http::withHeaders([
            'X-API-KEY' => self::$apiKey,
            'Accept'    => 'application/json',
        ])->get(self::$baseUrl . "/checkout/{$checkoutId}");

        $responseData = $response->json();

        // Log response
        Log::channel('nomod')->info('Nomod Get Checkout Response', $responseData);

        return $responseData;
    }
}
