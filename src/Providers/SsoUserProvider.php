<?php

declare(strict_types=1);

namespace Sso\SsoSdk\Providers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Session\Session;

class SsoUserProvider implements UserProvider
{
    public const SESSION_USER = "user";
    public const SESSION_TOKEN = "token";
    public const SESSION_SCOPES = "scopes";

    protected $session;

    public function __construct(
        Session $session
    ) {
        $this->session = $session;
    }
    public function retrieveById($identifier)
    {
        if (
            $this->session->has(self::SESSION_USER)
            && $this->session->get(self::SESSION_USER)->sso_id == $identifier
        ) {
            return $this->session->get(self::SESSION_USER);
        }
        return null;
    }

    public function retrieveByToken($identifier, $token)
    {
        return null;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        $user->setRememberToken($token);
    }

    public function retrieveByCredentials(array $credentials)
    {
        throw new AuthenticationException('SSOUserProvider: retrieveByCredentials (não utilizado)');
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        throw new AuthenticationException('SSOUserProvider: retrieveByCredentials (não utilizado)');
    }

    public function rehashPasswordIfRequired(Authenticatable $user, array $credentials, bool $force = false)
    {
        throw new AuthenticationException('SSOUserProvider: retrieveByCredentials (não utilizado)');
    }
}
