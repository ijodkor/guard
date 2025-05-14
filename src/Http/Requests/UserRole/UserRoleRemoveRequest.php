<?php

namespace Ijodkor\Guard\Http\Requests\UserRole;

use Ijodkor\ApiResponse\Requests\RestRequest;

class UserRoleRemoveRequest extends RestRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'roleId' => 'required|numeric'
        ];
    }
}
