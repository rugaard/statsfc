<?php
return [

    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | The API key is required to perform any requests to the API at all.
    |
    | You can find your API key under "Account settings" when you log into
    | your StatsFC account.
    |
    */
    'apiKey' => env('STATSFC_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Base URL
    |--------------------------------------------------------------------------
    |
    | Base URL of each endpoint. This should not change unless StatsFC changes
    | the URL of their API.
    |
    */
    'baseUrl' => env('STATSFC_BASE_URL', 'https://dugout.statsfc.com/api'),

    /*
    |--------------------------------------------------------------------------
    | Version
    |--------------------------------------------------------------------------
    |
    | Version of API. This should not change unless StatsFC releases a new
    | version of their API.
    |
    */
    'version' => env('STATSFC_VERSION', 'v1'),

];