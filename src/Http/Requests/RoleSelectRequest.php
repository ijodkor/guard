<?php

namespace Ijodkor\Guard\Http\Requests;

use Ijodkor\ApiResponse\Requests\RestRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class RoleSelectRequest extends RestRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array {
        return [
            'id' => "required|numeric"
        ];
    }
}
