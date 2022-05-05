<?php

namespace App\Http\Requests\UserCharacter;

use Illuminate\Foundation\Http\FormRequest;

class UserCharacterJoinRequest extends FormRequest
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
            'statistics' => 'nullable|array',
            'statistics.actualPv' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ];
    }
}
