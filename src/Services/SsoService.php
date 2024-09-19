<?php

namespace Sso\SsoSdk\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class SsoService
{
    public function enabled()
    {
        return config('sso.enabled');
    }

    public function getPartnership()
    {
        if (config('sso.partnership_get_type') == 'settings') {
            return app(ExternalAPISettings::class)->sso_partnership;
        }

        return config('sso.partnership');
    }

    private function getClient(): PendingRequest
    {
        return Http::baseUrl(config('sso.url'))
            ->acceptJson()
            ->withHeader('partnership', $this->getPartnership());
    }

    /**
     * @throws ConnectionException
     */
    public function accessToken(string $redirectToken): array
    {
        $response = $this->getClient()
            ->withToken($redirectToken)
            ->get('api/user/access-token');

        if ($response->status() !== 200) {
            throw new \RuntimeException('Unauthorized');
        }
        return $response->json();
    }

    public function validateTwoFactorCode(string $token, string|int $code): bool
    {
        $response = $this->getClient()
            ->withToken($token)
            ->post('api/user/confirm-code', [
                'code' => $code,
            ]);
        if ($response->status() !== 200) {
            return false;
        }
        return true;
    }

    public function checkPermissions(
        string $token,
        string|array|null $permission,
        ?string $guard = null
    ): bool
    {
        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        if (is_null($guard) && !empty(config('sso.default_guard'))) {
            $guard = (string) config('sso.default_guard');
        }

        $response = $this->getClient()
            ->withToken($token)
            ->post('api/user/check-permissions', [
                'permissions' => $permissions,
                'guard' => $guard,
            ]);
        if ($response->status() !== Response::HTTP_OK) {
            return false;
        }
        return true;
    }

    /**
     * @throws ConnectionException
     */
    public function user(string $token, bool $asObject = false): array|object
    {
        $response = $this->getClient()
            ->withToken($token)
            ->get('api/user/me');

        if ($response->status() !== 200) {
            throw new \RuntimeException('Unauthorized');
        }

        if ($asObject) {
            return (object) $response->json();
        }
        return $response->json();
    }

    /**
     * Check password admin
     */
    public function checkPassword(string $password, string $token): bool
    {
        $response = $this->getClient()
            ->withToken($token)
            ->post('api/user/check-password', [
                'password' => $password
            ]);

        if ($response->status() !== 200) {
            return false;
        }

        return true;
    }

    public function relogin(string $password, string $token): object
    {
        $response = $this->getClient()
            ->withToken($token)
            ->post('api/user/relogin', [
                'password' => $password
            ]);

        if ($response->status() !== 200) {
            throw new \RuntimeException('Unauthorized');
        }

        return (object) $response->json();
    }

    public function logout(string $token): array
    {
        $response = $this->getClient()
            ->withToken($token)
            ->post('api/user/logout');

        if ($response->status() !== 200) {
            throw new \RuntimeException('Unauthorized');
        }

        return $response->json();
    }
}