<?php

namespace App\Http\Requests\UserCharacter;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserCharacterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'level' => 'nullable|integer|min:1',
        ];
    }
}
