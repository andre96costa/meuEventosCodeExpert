<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $rules = [
            'user.name' => 'required',
            'user.email' => 'required|email|unique:users,email,'.auth()->id(),
        ];

        if ($this->request->get('user')['password']) {
            $rules['user.password'] = 'string|min:8|confirmed';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'Estes campos são obrigatórios'
        ];
    }
}
