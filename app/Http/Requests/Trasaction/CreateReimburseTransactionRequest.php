<?php

namespace App\Http\Requests\Trasaction;

use Illuminate\Foundation\Http\FormRequest;

class CreateReimburseTransactionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|integer',
            'amount' => 'required|numeric'
        ];
    }
}
