<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'livro_id' => [
                'required',
                'exists:livros,id'
            ],
            'indice_pai_id' => [
                'nullable',
            ],
            'titulo' => [
                'required',
                'string'
            ],
            'pagina' => [
                'required',
                'integer'
            ],
        ];
    }
}
