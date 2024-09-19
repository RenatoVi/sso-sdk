<?php

return [
    'enabled' => env('SSO_ENABLED', true),
    'tenant_enabled' => env('SSO_TENANT_ENABLED', false),
    'url' => env('SSO_URL', 'http://auth.docker'),
    'path' => env('SSO_PATH', 'sso'),
    'partnership' => env('SSO_PARTNERSHIP', '032c493d81fe1d4c6654fd07b2595a9c'),
    'user_model' => env('SSO_USER_MODEL', 'App\Models\User'),
    'default_guard' => env('SSO_DEFAULT_GUARD', 'web'),
    'partnership_get_type' => env('SSO_PARTNERSHIP_GET_TYPE', 'settings'),
];
