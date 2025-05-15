<?php

namespace Ijodkor\Guard\Http\Middlewares;

use Closure;
use Exception;
use Ijodkor\ApiResponse\Responses\RestResponse;
use Ijodkor\Guard\Models\User;
use Ijodkor\Guard\Services\Rbac\UserRoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\JWTGuard;

class RoleHasMiddleware {
    use RestResponse;

    public function __construct(private UserRoleService $userRoleService) {
    }

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws Exception
     */
    public function handle(Request $request, Closure $next): Response {
        /**
         * @var User $user
         * @var JWTGuard $guard
         */
        $guard = Auth::guard();
        $payload = $guard->payload();

        $roleId = $payload->get('role_id');
        if (!$roleId) {
            return $this->fail([], "User have not any role!", 403);
        }

        $role = $this->userRoleService->get($roleId);
        if (!$role) {
            return $this->fail([], "User have not any role!", 403);
        }

        $request->attributes->add(['role' => $role]);

        return $next($request);
    }
}
