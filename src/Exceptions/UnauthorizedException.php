<?php

namespace Sso\SsoSdk\Exceptions;

use Exception;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Symfony\Component\HttpKernel\Exception\HttpException;
use function App\Exceptions\config;

class UnauthorizedException extends HttpException
{
    private $requiredRoles = [];

    private $requiredPermissions = [];

    public static function forRoles(array $roles): self
    {
        $message = 'User does not have the right roles.';

        $exception = new static(403, $message, null, []);
        $exception->requiredRoles = $roles;

        return $exception;
    }

    public static function forPermissions(array $permissions = []): self
    {
        $message = 'User does not have the right permissions.';

        $exception = new static(403, $message, null, []);
        $exception->requiredPermissions = $permissions;

        return $exception;
    }

    public static function forRolesOrPermissions(array $rolesOrPermissions): self
    {
        $message = 'User does not have any of the necessary access rights.';

        $exception = new static(403, $message, null, []);
        $exception->requiredPermissions = $rolesOrPermissions;

        return $exception;
    }

    public static function missingTraitHasRoles(Authorizable $user): self
    {
        $class = get_class($user);

        return new static(403, "Authorizable class `{$class}` must use Spatie\Permission\Traits\HasRoles trait.", null, []);
    }

    public static function notLoggedIn(): self
    {
        return new static(403, 'User is not logged in.', null, []);
    }

    public function getRequiredRoles(): array
    {
        return $this->requiredRoles;
    }

    public function getRequiredPermissions(): array
    {
        return $this->requiredPermissions;
    }

}
