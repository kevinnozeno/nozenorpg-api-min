<?php

namespace App\Http\Requests\Roomable;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomableRequest extends FormRequest
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
            'is_active' => 'nullable|boolean',
            'statistics.order' => 'nullable|integer',
            'statistics.playing' => 'nullable|boolean',
            'statistics.actualPv' => 'nullable|integer',
        ];
    }
}
