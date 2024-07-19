<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class UmamiService
{
    public static function getToken()
    {
        $response = Http::post(config('services.umami.api') . '/auth/login', [
            'username' => config('services.umami.user'),
            'password' => config('services.umami.password')
        ]);
        $token = $response->json()['token'];
        session()->put('umami_token', $token);
        return $token;
    }

    public static function retrieveToken()
    {
        $token = session('umami_token');
        if (!$token) {
            return self::getToken();
        } else {
            return $token;
        }
    }

    public static function testConnection()
    {
        $response = Http::withToken(self::retrieveToken())->get(config('services.umami.api') . '/websites');
        dd($response->body());
    }

    public static function getActiveUsers()
    {
        $response = Http::withToken(self::retrieveToken())->get(config('services.umami.api') . '/websites/' . config('services.umami.website_id') . '/active');
        return $response;
    }

    public static function getEvents($start = null, $end = null)
    {
        if (!$start) {
            $start = now()->subMonths(1)->timestamp;
        }
        if (!$end) {
            $end = now()->timestamp;
        }
        $queryParams = http_build_query([
            'startAt' => $start,
            'endAt' => $end,
            'unit' => 'day',
            'timezone' => 'Europe/London'
        ]);
        $url = config('services.umami.api') . '/websites/' . config('services.umami.website_id') . '/events?' . $queryParams;
        $response = Http::withToken(self::retrieveToken())->get($url);
        return $response;
    }

    public static function getPageViews($start = null, $end = null)
    {
        if (!$start) {
            $start = now()->subMonths(1)->timestamp;
        }
        if (!$end) {
            $end = now()->timestamp;
        }
        $queryParams = http_build_query([
            'startAt' => $start,
            'endAt' => $end,
            'unit' => 'day',
            'timezone' => 'Europe/London'
        ]);
        $url = config('services.umami.api') . '/websites/' . config('services.umami.website_id') . '/pageviews?' . $queryParams;
        //  $response = Http::withToken(self::retrieveToken())->get($url);
        $response = Http::withToken(self::retrieveToken())->get(config('services.umami.api') . '/websites');
        return $response;
    }
}
