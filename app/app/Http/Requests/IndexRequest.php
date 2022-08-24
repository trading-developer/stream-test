<?php

namespace App\Http\Requests;

use App\Services\Antmedia\Broadcasts;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'offset' => [
                'sometimes',
                'integer',
                'min:0',
                'max:1000',
            ],
            'size' => [
                'sometimes',
                'integer',
                Rule::in(
                    Broadcasts::PER_PAGES_TYPES
                )
            ],

        ];
    }
}
