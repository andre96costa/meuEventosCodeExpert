<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'title'         => 'required|min:3',
            'description'   => 'required',
            'body'          => 'required',
            'start_event'   => 'required',
            'banner'        => 'image'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'min' => 'Este campo não atingiu o mínimo de caracteres permitidos. Tamanho mínimo permitido :min',
            'image' => 'Apenas arquivos PNG e JPG são aceitos'
        ];
    }
}
