<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemerintahanPKKRequest extends FormRequest
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
            'profile' => ['required','image','mimes:jpeg,png,jpg','max:2048'],
            'nama'=>['required','string','max:100'],
            'jabatan'=>['required','string','max:100'],
            'tmpt_lahir'=>['required','string','max:100'],
            'jenis_kelamin'=>['required','int'],
            'tgl_lahir'=>['required','date'],
            'alamat'=>['required','string','max:250'],
            'no_telepon' => ['required', 'string'],
            'no_sk' => ['required', 'string'],
            'tgl_sk' => ['required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'profile.required' => 'Profile wajib diisi.',
            'nama.required' => 'Nama wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'tmpt_lahir.required' => 'Tempat Lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi.',
            'tgl_lahir.required' => 'Tanggal Lahir wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'no_telepon.required' => 'Nomor Telepon wajib diisi.',
            'no_sk.required' => 'Nomor SK wajib diisi.',
            'tgl_sk.required' => 'Tanggal SK wajib diisi.',

        ];
    }
}
