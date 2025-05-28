<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SortitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'nullable|integer|min:0',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0.01|max:99999999.99',
            'numbers' => 'required|integer|min:0',
            'date' => 'required|string|max:255',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120', // Até 2MB
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Campo "Título" obrigatório.',
            'description.required' => 'Campo "Descrição" obrigatório.',
            'price.required' => 'Campo "Preço" obrigatório.',
            'price.numeric' => 'Valor do "Preço" inválido. Verfique e tente novamente.',
            'numbers.required' => 'Campo "Números" obrigatório.',
            'date.required' => 'Campo "Data" obrigatório.',
            'image.required' => 'Campo "Imagem" obrigatório.',
            'image.file' => 'Arquivo inválido',
            'image.mimes' => 'Arquivo inválido. Permitidos: jpg,png ou webp.',
            'image.max' => 'Arquivo deve ser igual ou inferior a 5MB.',
        ];
    }
}
