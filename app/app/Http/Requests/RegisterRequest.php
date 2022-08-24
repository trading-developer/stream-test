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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email', //:rfc,dns
            'name' => 'required|min:2|max:36',
            'secret_key' => 'required|unique:users,secret_key',
            'password' => 'required|min:4',
            'password_confirmation' => 'required|same:password'
        ];
    }
}
