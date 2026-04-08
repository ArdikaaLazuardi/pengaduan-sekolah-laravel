<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminAspirasiUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
{
    return [
        'status' => ['required', Rule::in(['Menunggu', 'Proses', 'Selesai'])],
        'feedback' => ['nullable', 'string', 'max:2000'],
        'progress_persen' => ['nullable', 'integer', 'min:0', 'max:100'],
        'catatan_progress' => ['nullable', 'string', 'max:2000'],
    ];
}
}
