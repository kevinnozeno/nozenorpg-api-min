<?php

namespace App\Http\Requests\Character;

use Illuminate\Foundation\Http\FormRequest;

class StoreCharacterRequest extends FormRequest
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
            'pv' => 'required|integer',
            'ad' => 'required|integer',
            'ap' => 'required|integer',
            'heal' => 'required|integer',
            'plays' => 'integer'
        ];
    }
}
