<?php

namespace App\Http\Requests\Skill;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSkillRequest extends FormRequest
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
            'slug' => 'nullable|string',
            'name' => 'nullable|string',
            'color' => 'nullable|string',
            'level' => 'nullable|integer',
            'type' => 'nullable|string|in:me,one,multi'
        ];
    }
}
