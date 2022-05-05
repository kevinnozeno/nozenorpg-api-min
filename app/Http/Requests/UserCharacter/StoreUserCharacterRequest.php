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
            'room_id' => 'required|integer',
            'roomable_id' => 'required|integer',
            'roomable_type' => 'required|string',
            'statistics' => 'nullable|array',
            'is_active' => 'nullable|boolean',
        ];
    }

    /**
     * The data to be validated should be processed as JSON.
     */
    protected function prepareForValidation()
    {
        return  $this->merge(json_decode($this->statistics, true));
    }
}
