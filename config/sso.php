<?php

return [
    'url' => env('SSO_URL', 'http://auth.docker'),
    'path' => env('SSO_PATH', 'sso'),
    'partnership' => env('SSO_PARTNERSHIP', ''),
    'user_model' => env('SSO_USER_MODEL', 'App\Models\User'),
    'display_permission_in_exception' => env('SSO_DISPLAY_PERMISSION_IN_EXCEPTION', true),
];
