<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLaporanRequest extends FormRequest
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
            'unit_id' => 'sometimes|exists:unit_pemadam,id',
            'status' => 'sometimes|in:received,in_progress,dispatched,completed',
        ];
    }

    public function messages(): array
    {
        return [
            'status.in' => 'Status laporan tidak valid.',
            'unit_id.exists' => 'Unit tidak ditemukan.',
        ];
    }
}
