<?php

namespace App\Http\Sim\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'groups_id' => 'string|json',
            'contracts_id' => 'string|json',
            'phones' => 'string|json',
        ];
    }

    public function messages(): array
    {
        return [
            'groups_id.json' => 'Идентификаторы групп должны быть массивом',
            'contracts_id.json' => 'Идентификаторы контрактов должны быть массивом',
            'phones.json' => 'Телефоны должны быть массивом',
        ];
    }
}
