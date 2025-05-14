<?php

namespace Ijodkor\Guard\Http\Controllers\Rbac;

use Exception;
use Ijodkor\ApiResponse\Responses\RestResponse;
use Ijodkor\Guard\Http\Controllers\Controller;
use Ijodkor\Guard\Http\Requests\PositionCreateRequest;
use Ijodkor\Guard\Http\Requests\PositionUpdateRequest;
use Ijodkor\Guard\Http\Resources\PositionResource;
use Ijodkor\Guard\Services\Rbac\PositionService;
use Illuminate\Http\JsonResponse;

class PositionController extends Controller {
    use RestResponse;

    public function __construct(
        private PositionService $service
    ) {
    }

    public function index(): JsonResponse {
        try {
            return $this->success([
                'positions' => PositionResource::collection($this->service->all())
            ]);
        } catch (Exception $exception) {
            return $this->fail(message: $exception->getMessage());
        }
    }

    public function store(PositionCreateRequest $request): JsonResponse {
        try {
            $model = $this->service->create($request->validated());
            return $this->success(['position' => $model]);
        } catch (Exception $exception) {
            return $this->fail(message: $exception->getMessage());
        }
    }

    public function show(int $id): JsonResponse {
        $model = $this->service->find($id);
        return $this->success(['position' => PositionResource::make($model)]);
    }

    public function update(PositionUpdateRequest $request, string $id): JsonResponse {
        try {
            $model = $this->service->update($id, $request->validated());
            return $this->success(['position' => $model]);
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
