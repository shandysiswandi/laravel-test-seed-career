<?php

namespace App\Http\Requests\CompanyBudget;

use Illuminate\Foundation\Http\FormRequest;

class GetCompanyBudgetRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|integer'
        ];
    }
}
