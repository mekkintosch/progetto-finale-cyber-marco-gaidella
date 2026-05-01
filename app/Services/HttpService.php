<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class HttpService
{
    public function getRequest($url)
    {

        if (str_contains($url, 'internal.finance')) {

            if (!Auth::check() || Auth::user()->role !== 'admin') {
                abort(403, 'Access denied: insufficient privileges');
            }
        }

        return Http::get($url)->body();
    }
}