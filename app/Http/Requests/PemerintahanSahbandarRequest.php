<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemerintahanSahbandarRequest extends FormRequest
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
        ];
    }

    public function messages(): array
    {
        return [
            'profile.required' => 'Profile harus diisi.',
            'nama.required' => 'Nama harus diisi.',
            'jabatan.required' => 'Jabatan harus diisi.',
            'tmpt_lahir.required' => 'Tempat Lahir harus diisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi.',
            'tgl_lahir.required' => 'Tanggal Lahir harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
        ];
    }
}
