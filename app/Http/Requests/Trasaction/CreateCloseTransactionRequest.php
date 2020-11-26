<?php

namespace App\Http\Requests\Trasaction;

use Illuminate\Foundation\Http\FormRequest;

class CreateCloseTransactionRequest extends FormRequest
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
