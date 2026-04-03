<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOwnAspirasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'lokasi' => ['required', 'string', 'max:100'],
            'ket' => ['required', 'string', 'max:2000'],
        ];
    }
}
