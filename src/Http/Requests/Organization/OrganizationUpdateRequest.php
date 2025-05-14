<?php

namespace Ijodkor\Guard\Http\Requests\Organization;

use Ijodkor\ApiResponse\Requests\RestRequest;

class OrganizationUpdateRequest extends RestRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'short_name' => 'required|string',
            'address' => 'required|string',
            'account' => 'nullable|string',
            'mfo' => 'nullable|string'
        ];
    }
}
