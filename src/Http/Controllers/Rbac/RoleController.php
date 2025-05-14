<?php

namespace Ijodkor\Guard\Http\Controllers\Rbac;

use Exception;
use Ijodkor\Guard\Attributes\RoleLevel;
use Ijodkor\Guard\Entities\RoleLevelEntity;
use Ijodkor\Guard\Http\Controllers\Controller;
use Ijodkor\Guard\Http\Requests\RoleCreateRequest;
use Ijodkor\Guard\Http\Requests\RoleUpdateRequest;
use Ijodkor\Guard\Http\Resources\RoleResource;
use Ijodkor\Guard\Http\Resources\RoleViewResource;
use Ijodkor\Guard\Services\Rbac\RoleService;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller {

    public function __construct(
        private RoleService $service
    ) {
    }

    #[RoleLevel(RoleLevelEntity::ADMIN)]
    public function index(): JsonResponse {
        try {
            return $this->success([
                'roles' => RoleResource::collection($this->service->all())
            ]);
        } catch (Exception $exception) {
            return $this->fail(message: $exception->getMessage());
        }
    }

    #[RoleLevel(RoleLevelEntity::ADMIN)]
    public function store(RoleCreateRequest $request): JsonResponse {
        try {
            $model = $this->service->create($request->validated());
            return $this->success(['role' => $model]);
        } catch (Exception $exception) {
            return $this->fail(message: $exception->getMessage());
        }
    }

    public function show(int $id): JsonResponse {
        $model = $this->service->find($id);
        return $this->success(['role' => RoleViewResource::make($model)]);
    }

    public function update(RoleUpdateRequest $request, string $id): JsonResponse {
        try {
            $model = $this->service->update($id, $request->validated());
            return $this->success(['role' => $model]);
        } catch (Exception $exception) {
            return $this->fail(message: $exception->getMessage());
        }
    }

    public function destroy(int $id): JsonResponse {
        try {
            $this->service->delete($id);
            return $this->success();
        } catch (Exception $exception) {
            return $this->fail(message: $exception->getMessage());
        }
    }
}
