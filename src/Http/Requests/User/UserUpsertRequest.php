<?php

namespace Ijodkor\Guard\Http\Requests\User;

use Ijodkor\ApiResponse\Requests\RestRequest;

class UserUpsertRequest extends RestRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'pin' => 'required|numeric|digits:14',
            'tin' => "required|numeric",
            'organization_id' => "nullable|numeric|exists:organizations,id",
        ];
    }
}
