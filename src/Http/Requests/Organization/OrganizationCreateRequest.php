<?php

namespace Ijodkor\Guard\Http\Requests\Organization;

use Ijodkor\ApiResponse\Requests\RestRequest;

class OrganizationCreateRequest extends RestRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'tin' => 'required|numeric:digits:9|unique:organizations,tin',
            'short_name' => 'required|string',
            'region_id' => 'nullable|numeric',
        ];
    }
}
