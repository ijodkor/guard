<?php

namespace Ijodkor\Guard\Http\Controllers\User;

use Exception;
use Ijodkor\Guard\Attributes\RoleLevel;
use Ijodkor\Guard\Entities\RoleLevelEntity;
use Ijodkor\Guard\Http\Controllers\Controller;
use Ijodkor\Guard\Http\Requests\User\UserRequest;
use Ijodkor\Guard\Http\Requests\User\UserUpdateRequest;
use Ijodkor\Guard\Http\Requests\User\UserUpsertRequest;
use Ijodkor\Guard\Http\Resources\UserResource;
use Ijodkor\Guard\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller {

    public function __construct(
        private UserService $service
    ) {
    }

    #[RoleLevel(RoleLevelEntity::ADMIN)]
    public function index(UserRequest $request): JsonResponse {
        try {
            $users = $this->service->all($request->validated());

            return $this->paginated(UserResource::collection($users), 'users');
        } catch (Exception $exception) {
            return $this->fail(message: $exception->getMessage());
        }
    }

    public function store(UserUpsertRequest $request): JsonResponse {
        try {
            $model = $this->service->createUnnamed($request->validated()); // $organization->id

            return $this->success(['user' => $model]);
        } catch (Exception $exception) {
            return $this->fail(message: $exception->getMessage());
        }
    }

    public function show(int $id): JsonResponse {
        $model = $this->service->find($id);
        return $this->success(['user' => UserResource::make($model)]);
    }

    public function update(UserUpdateRequest $request, int $id): JsonResponse {
        try {
            $model = $this->service->update($id, $request->validated());
            return $this->success(['user' => $model]);
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
