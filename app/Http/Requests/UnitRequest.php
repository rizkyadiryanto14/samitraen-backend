<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
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
            'wilayah_id' => 'required',
            'nama_unit' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'wilayah_id.required' => 'Wilayah harus dipilih',
            'nama_unit.required' => 'Nama unit harus diisi',
        ];
    }
}
