<?php

namespace App\Http\Requests\Roomable;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomableRequest extends FormRequest
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
            'roomable_type' => 'required|string',
            'roomable_id' => 'required|integer'
        ];
    }
}
