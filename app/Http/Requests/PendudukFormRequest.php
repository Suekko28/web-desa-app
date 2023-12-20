<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PendudukFormRequest extends FormRequest
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
            'nama'=>['required','string','max:100'],
            'jabatan'=>['required','string','max:100'],
            'tmpt_lahir'=>['required','string','max:100'],
            'jenis_kelamin'=>['required','int'],
            'tgl_lahir'=>['required','date'],
            'alamat'=>['required','string','max:250'],
            'tgl_pindah_masuk'=>['required','date'],
            'NIK'=>['required','int'],

            

            'nama.required' => 'Nama Wajib Diisi',
            'jabatan.required' => 'Jabatan Wajib Diisi',
            'tmpt_lahir.required' => 'Tempat Lahir Wajib Diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin Wajib Diisi',
            'tgl_lahir.required' => 'Tanggal Lahir Wajib Diisi',
            'alamat.required' => 'Alamat Wajib Diisi',
            
        ];
    }
}
