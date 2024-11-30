<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLaporanRequest extends FormRequest
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
            'foto_bukti'        => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi_laporan' => 'required',
            'latitude'          => ['required','regex:/^(\+|-)?(?:90(?:\.0{1,15})?|[0-9]{1,2}(?:\.[0-9]{1,15})?)$/'],
            'longitude'         => ['required','regex:/^(\+|-)?(?:180(?:\.0{1,15})?|((1[0-7][0-9]|[0-9]{1,2})(\.[0-9]{1,15})?))$/'],
            'no_hp'             => 'sometimes',
        ];
    }

    public function messages()
    {
        return [
            'foto_bukti.required'        => 'Foto bukti diperlukan.',
            'foto_bukti.image'           => 'Foto bukti harus berupa gambar.',
            'foto_bukti.mimes'           => 'Foto bukti harus bertipe: jpeg, png, jpg.',
            'foto_bukti.max'             => 'Foto bukti tidak boleh lebih dari 2048 kilobytes.',
            'deskripsi_laporan.required' => 'Deskripsi laporan diperlukan.',
            'latitude.required'          => 'Latitude diperlukan.',
            'longitude.required'         => 'Longitude diperlukan.',
            'latitude.regex'            => 'Data latitude tidak valid',
            'longitude.regex'           => 'Data longitude tidak valid',
        ];
    }
}
