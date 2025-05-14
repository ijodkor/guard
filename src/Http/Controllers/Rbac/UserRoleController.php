<?php

namespace Ijodkor\Guard\Http\Controllers\Rbac;

use Exception;
use Ijodkor\Guard\Http\Controllers\Controller;
use Ijodkor\Guard\Http\Requests\UserRole\UserRoleCreateRequest;
use Ijodkor\Guard\Http\Requests\UserRole\UserRoleRemoveRequest;
use Ijodkor\Guard\Http\Resources\UserRoleResource;
use Ijodkor\Guard\Services\Rbac\UserRoleService;
use Ijodkor\Guard\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserRoleController extends Controller {

    public function __construct(
        private UserRoleService $service,
        private UserService     $userService,
    ) {
    }

    public function index(int $id): JsonResponse {
        try {
            $user = $this->userService->find($id);
            $user->load(['roles.role', 'roles.organization']);
            $roles = $user->roles;
            return $this->success([
                'roles' => UserRoleResource::collection($roles)
            ]);
        } catch (Exception $exception) {
            return $this->fail(message: $exception->getMessage());
        }
    }

    public function store(UserRoleCreateRequest $request): JsonResponse {
        try {
            $model = $this->service->create($request->validated());
            return $this->success(['userRole' => $model]);
        } catch (Exception $exception) {
            return $this->fail(message: $exception->getMessage());
        }
    }

    public function destroy(UserRoleRemoveRequest $request): JsonResponse {
        try {
            $this->service->delete($request->get('roleId'));
            return $this->success();
        } catch (Exception $exception) {
            return $this->fail(message: $exception->getMessage());
        }
    }
}
