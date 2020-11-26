<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|integer',
            'first_name' => 'nullable|string|min:3|max:100',
            'last_name' => 'nullable|string|min:3|max:100',
            'email' => 'nullable|email|unique:users,email,' . request()->id . '|max:100',
        ];
    }
}
