<?php

namespace Ijodkor\Guard\Http\Controllers\User;

use Exception;
use Ijodkor\Guard\Http\Controllers\Controller;
use Ijodkor\Guard\Http\Requests\Organization\OrganizationCreateRequest;
use Ijodkor\Guard\Http\Requests\Organization\OrganizationRequest;
use Ijodkor\Guard\Http\Requests\Organization\OrganizationUpdateRequest;
use Ijodkor\Guard\Http\Resources\OrganizationResource;
use Ijodkor\Guard\Models\Organization;
use Ijodkor\Guard\Services\OrganizationService;
use Illuminate\Http\JsonResponse;

class OrganizationController extends Controller {

    public function __construct(
        private OrganizationService $service,
        // private TaxpayerService $taxpayerService,
    ) {
    }

    public function index(OrganizationRequest $request): JsonResponse {
        try {
            return $this->paginated(OrganizationResource::collection($this->service->all($request->validated())), 'organizations');
        } catch (Exception $exception) {
            return $this->fail(message: $exception->getMessage());
        }
    }

    public function store(OrganizationCreateRequest $request): JsonResponse {
        try {
            // $organization = $this->taxpayerService->getOrganization($request->get('tin'));
            /*
             $model = $this->service->create([
                'name' => $organization['name'],
                'tin' => $organization['tin'],
                'short_name' => $request->get('short_name'),
                'director' => $organization['director'],
                'pin' => $organization['pin'],
                'address' => $organization['address'],
                'region_id' => $organization['region_id'],
            ]);
            */
            return $this->success(['organization' => new Organization()]);
        } catch (Exception $exception) {
            return $this->fail(message: $exception->getMessage());
        }
    }

    public function show(int $id): JsonResponse {
        $model = $this->service->find($id);
        return $this->success(['organization' => OrganizationResource::make($model)]);
    }

    public function update(OrganizationUpdateRequest $request, string $id): JsonResponse {
        try {
            $model = $this->service->update($id, $request->validated());
            return $this->success(['organization' => $model]);
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
