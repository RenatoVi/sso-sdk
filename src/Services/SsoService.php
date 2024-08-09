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
        string|array $permission,
        ?string $guard = null
    ): bool
    {
        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

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
    public function existDocument(bool $token): array
    {
        $response = $this->getClient()
            ->withToken($token)
            ->get('api/user/me');

        if ($response->status() !== 200) {
            throw new \RuntimeException('Unauthorized');
        }

        return $response->json();
    }
}