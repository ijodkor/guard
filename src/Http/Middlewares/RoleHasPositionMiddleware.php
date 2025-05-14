<?php

namespace Ijodkor\Guard\Http\Middlewares;

use Ijodkor\Guard\Models\Rbac\Role;
use Closure;
use Exception;
use Ijodkor\ApiResponse\Responses\RestResponse;
use Ijodkor\Guard\Attributes\RoleLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use ReflectionAttribute;
use ReflectionMethod;
use Symfony\Component\HttpFoundation\Response;

class RoleHasPositionMiddleware {
    use RestResponse;

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws Exception
     */
    public function handle(Request $request, Closure $next): Response {
        /**
         * @var ReflectionAttribute $attr
         * @var mixed $guard
         * @var Role $role
         */

        $roleLink = $request->get('role');
        if (!$roleLink) {
            return $this->fail([
                'message' => "User have not any role!"
            ]);
        }

        $role = $roleLink->role;

        $class = $request->route()->getControllerClass();
        $method = $request->route()->getActionMethod();

        $reflector = new ReflectionMethod($class, $method);
        $attributes = $reflector->getAttributes(RoleLevel::class);
        if (count($attributes) < 1) {
            return $next($request);
        }

        $attr = Arr::first($attributes);

        [$position] = $attr->getArguments();
        if ($position < $role->level) {
            return $this->fail([], "User cannot access to route in this level!", 403);
        }

        return $next($request);
    }
}
