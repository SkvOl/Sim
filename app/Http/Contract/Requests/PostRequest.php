<?php
namespace App\Http\Contract\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->is_admin === 1;
    }

    /**
     * Получить правила валидации для запроса.
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
            'description' => 'string',
        ];
    }

    /**
     * Получить сообщения об ошибках валидации.
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'Идентификатор пользователя обязателен',
            'user_id.integer' => 'Идентификатор пользователя должен быть числом',
            'description.string' => 'Содержание обязательно.',
        ];
    }
}
