<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'sex' => 'required',
            'city' => 'required',
            'age' => 'required|numeric|max:127',
        ];
    }
}
