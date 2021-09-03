<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'phone' => 'required',
            'email' => 'email|unique:customers,email',
            'gender' => 'required',
            'password' => 'required|min:8',
            'email_verified_at' => 'required'
        ];
    }
}
