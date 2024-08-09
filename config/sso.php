<?php

return [
    'enabled' => env('SSO_ENABLED', true),
    'url' => env('SSO_URL', 'http://auth.docker'),
    'path' => env('SSO_PATH', 'sso'),
    'partnership' => env('SSO_PARTNERSHIP', '032c493d81fe1d4c6654fd07b2595a9c'),
    'user_model' => env('SSO_USER_MODEL', 'App\Models\User'),
    'default_guard' => env('SSO_DEFAULT_GUARD', 'web'),
];
