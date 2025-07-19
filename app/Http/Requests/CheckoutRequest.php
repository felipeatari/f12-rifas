<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'cpf' => ['required', 'string'],
            'whatsapp' => ['required', 'string', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Campo "Nome" é obrigatório.',
            'cpf.required' => 'Campo "CPF" é obrigatório.',
            'whatsapp.required' => 'Campo "WhatsApp" é obrigatório.',
            'whatsapp.confirmed' => 'Os números do WhatsApp são diferentes.',
            'whatsapp.regex' => 'Informe um número de WhatsApp válido.',
        ];
    }
}
