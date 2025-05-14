<?php

namespace Ijodkor\Guard\Http\Requests\Organization;

use Ijodkor\ApiResponse\Requests\RestRequest;

class OrganizationRequest extends RestRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'limit' => 'nullable|numeric',
            'name' => 'nullable|string',
            'tin' => 'nullable|numeric'
        ];
    }
}
