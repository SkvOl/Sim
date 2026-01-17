<?php
namespace App\Http\Contract\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->is_admin === 1;
    }
}
