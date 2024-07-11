<?php

return [
    'url' => env('SSO_URL', 'http://auth.docker'),
    'path' => env('SSO_PATH', 'sso'),
    'partnership' => env('SSO_PARTNERSHIP', 'c143841532b7d874d336ef86f0075366'),
    'user_model' => env('SSO_USER_MODEL', 'App\Models\User'),
];
