<?php

namespace Ijodkor\Guard\Http\Requests;

class RoleUpdateRequest extends RoleCreateRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'type' => 'required|integer|between:1,5',
            'name' => 'required|string',
            'title.uz' => ['required_without_all:title.ru,title.en'],
            'title.ru' => ['required_without_all:title.uz,title.en'],
            'title.en' => ['required_without_all:title.uz,title.ru'],
            'level' => 'required|integer'
        ];
    }
}
