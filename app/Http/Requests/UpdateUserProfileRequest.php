<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
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
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email,' . Auth::id(),
            'foto_profil'   => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password'      => 'sometimes',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Nama harus diisi',
            'email.required'    => 'Email harus diisi',
            'email.unique'      => 'Email sudah terdaftar',
            'foto_profil.image' => 'File harus berupa gambar',
            'foto_profil.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'foto_profil.max'   => 'Ukuran gambar maksimal 2MB',
        ];
    }
}
