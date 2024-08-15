<?php

namespace Sso\SsoSdk\Facades;

use Illuminate\Support\Facades\Facade;
use Sso\SsoSdk\Services\SsoService;

/**
 * @method static bool enabled()
 * @method static array accessToken(string $redirectToken)
 * @method static bool checkPermissions(string $token, string|array $permission, ?string $guard = null)
 * @method static array|object user(string $token, bool $asObject = false)
 * @method static bool validateTwoFactorCode(string $token, string|int $code)
 * @method static bool checkPassword(string $password, string $token)
 * @method static bool relogin(string $password, string $token)
 * @method static bool logout(string $token)
 */
class Sso extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return SsoService::class;
    }
}
