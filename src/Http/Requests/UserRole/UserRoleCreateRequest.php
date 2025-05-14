<?php

namespace Ijodkor\Guard\Http\Requests\UserRole;

use Ijodkor\ApiResponse\Requests\RestRequest;

class UserRoleCreateRequest extends RestRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'user_id' => 'required|numeric',
            'role_id' => 'required|numeric',
            'organization_id' => 'nullable|numeric',
            'position_id' => 'nullable|numeric',
            'region_id' => 'nullable|numeric',
        ];
    }
}
