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

    private function getClient(): PendingRequest
    {
        return Http::baseUrl(config('sso.url'))
            ->acceptJson()
            ->withHeader('partnership', config('sso.partnership'));
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
}