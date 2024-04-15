<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Storecategory_courseRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    //        |mimes:image/png,image/jpg,image/jpeg,image/webp|max:10000'

    public function rules(): array
    {
        return [
            'name' => 'required',
            'img' => 'required',

        ];
    }
}
