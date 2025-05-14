<?php

namespace Ijodkor\Guard\Http\Requests;

use Ijodkor\ApiResponse\Requests\RestRequest;

class PositionCreateRequest extends RestRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'name' => 'required'
        ];
    }
}
