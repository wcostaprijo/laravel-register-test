<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'cep' => 'required|min:8|max:8',
            'number' => 'nullable|integer',
            'complement' => 'nullable|string',
        ];
    }
    
    public function prepareForValidation(): void
    {
        $this->merge([
            'cep' => removeCepMask($this->cep),
            'number' => empty($this->number) ? 0 : intval($this->number),
        ]);
    }
}
