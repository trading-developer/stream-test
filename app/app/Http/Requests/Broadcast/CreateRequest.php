<?php

namespace App\Http\Requests\Broadcast;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class CreateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:50',
            ],
            'description' => [
                'required',
                'string',
                'max:100',
            ],
            'preview' => [
                'required',
                File::types(['jpg', 'jpeg', 'png']),
                'max:10000', //10mb
            ]
        ];
    }
}
