<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'number' => 'required|numeric',
            'name' => 'required|string',
            'category' => 'required|string',
            'prerequisite' => 'required|string',
            'teacherName' => 'required|string',
            'duration' => 'required|string',
        ];
    }
}
