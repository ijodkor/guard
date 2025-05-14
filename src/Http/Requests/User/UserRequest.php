<?php

namespace Ijodkor\Guard\Http\Requests\User;

use Ijodkor\ApiResponse\Requests\RestRequest;

class UserRequest extends RestRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'organization_id' => "nullable|numeric",
            'username' => "nullable|string",
            'pin' => 'nullable|numeric',
            'name' => 'nullable|string',
        ];
    }
}
