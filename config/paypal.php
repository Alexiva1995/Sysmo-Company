<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'app_id'            => 'APP-80W284485P519543T',
        'client_id'   => 'eyJpdiI6IlZ2bXlmZGNsSENSM0tLWW1rcGtmb3c9PSIsInZhbHVlIjoidjZyYVNxbEYvUnFBSEVYYXFVdkJSeDRGZys0YWV3V1RNYTlMdHZZb3IyVUp2V2ovQis3N0wyc1JPWXJxSXYxc2orTExYWHd1Nmt0MTR2aWpUaGFGQ25WNzE0MlZ6Wi9yWmJ3a2QzT1BlYXRpZ0ljMUFVN2VnYTR6eFZsNzlXR1IiLCJtYWMiOiI3YjhkZWMxYmFlYzcxNDIxMjVhYTA1ODlmMTg2YzAxNmYwMGFkODQwNDU3OTM0YmQ4ZDBhNGE1MjA4NWM0OTNlIiwidGFnIjoiIn0=',
        'client_secret'=> 'eyJpdiI6Ik05UitwNFBKbENPRU1xdHJPaTJraHc9PSIsInZhbHVlIjoiWXZvL0pEZS9XQnorZlQvd3lQaW56NHAvcDI0ZXQ0cFlGM1VYV0U0VERjbFVGTEtYZnMzS2dZZkl5dXFsODZlLzRZZGwrTXAzK3pYYUU0VTB0dEcwMkVGM05iMTFKUDVtNGs4cURUSHdVQUt4a0hsUmVnODNNa0h5Qjd4dXRYK20iLCJtYWMiOiI4NmQwY2I5NDhlNjc1NDMzM2M1MWEyMjA5ZmM0YWMxYmI4NmRjZjY3MTk2OTgwMDZhY2I1ODRmYzBkZDE5YmY2IiwidGFnIjoiIn0=',
    ],
    'live' => [
        'client_id'         => env('PAYPAL_LIVE_CLIENT_ID', ''),
        'client_secret'     => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
        'app_id'            => '',
    ],

    'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => env('PAYPAL_CURRENCY', 'USD'),
    'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
    'locale'         => env('PAYPAL_LOCALE', 'es_ES'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
];
