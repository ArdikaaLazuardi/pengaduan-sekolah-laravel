<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SiswaLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nis' => ['required', 'string', 'max:20', 'exists:siswas,nis'],
        ];
    }

    public function messages(): array
    {
        return [
            'nis.exists' => 'NIS tidak ditemukan. Hubungi admin sekolah.',
        ];
    }
}
