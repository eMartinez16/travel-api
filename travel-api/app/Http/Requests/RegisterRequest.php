<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'     => 'string|required',
            'lastname' => 'string|required',
            'email'    => 'string|required|unique:users',
            'password' => 'required|min:8'
        ];
    }

    /**not needed but we can use the function messages to use custom msg */
}
