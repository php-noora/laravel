<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {


        dd(123);

        return [
            'title' => 'required',
            'Description' => 'required',
            'img' => 'required',
            'price' => 'required',
            'time' => 'required',
            'lecturer_id' => 'required',
            'category_course_id' => 'required',
        ];
    }
}
