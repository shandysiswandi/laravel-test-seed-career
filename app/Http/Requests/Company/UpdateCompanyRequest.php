<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|integer',
            'name' => 'nullable|string|min:3|max:255',
            'address' => 'nullable|string|min:3|max:100',
        ];
    }
}
