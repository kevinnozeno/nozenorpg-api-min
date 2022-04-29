<?php

namespace App\Http\Requests\UserCharacter;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserCharacterRequest extends FormRequest
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
            'users' => 'required|array',
            'characters' => 'required|array',
            'level' => 'integer|min:1',
            'pv_modif' => 'integer'
        ];
    }
}
