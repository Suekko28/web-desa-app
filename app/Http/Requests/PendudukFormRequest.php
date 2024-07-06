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
            'tgl_pindah_masuk' => ['required', 'date'],
            'tgl_lapor' => ['required', 'date'],
            'NIK' => ['required', 'int'],
            'NKK' => ['required', 'int'],
            'nama' => ['required', 'string', 'max:100'],
            'tempat_lahir' => ['required', 'string', 'max:100'],
            'tgl_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'int'],
            'agama' => ['required', 'string', 'max:100'],
            'kewarganegaraan' => ['required', 'string', 'max:100'],
            'status_pernikahan' => ['required', 'string', 'max:100'],
            'dusun' => ['required', 'string', 'max:100'],
            'rt' => ['required', 'string', 'max:5'],
            'rw' => ['required', 'string', 'max:5'],
            'alamat' => ['required', 'string', 'max:250'],
            'pendidikan' => ['required', 'string', 'max:100'],
            'pekerjaan' => ['required', 'string', 'max:100'],
            'kepemilikan_bpjs' => ['required', 'string', 'max:100'],
            'kepemilikan_e_ktp' => ['required', 'string', 'max:100'],
            'nama_ibu' => ['required', 'string', 'max:100'],
            'nama_ayah' => ['required', 'string', 'max:100'],
            // 'user_id' => ['required'],


        ];


    }

    public function messages(): array
    {
        return [
            'tgl_pindah_masuk.required' => 'Tanggal Pindah Masuk wajib diisi.',
            'tgl_lapor.required' => 'Tanggal Lapor wajib diisi.',
            'NIK.required' => 'NIK wajib diisi.',
            'NKK.required' => 'NKK wajib diisi.',
            'nama.required' => 'Nama wajib diisi.',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi.',
            'tgl_lahir.required' => 'Tanggal Lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi.',
            'agama.required' => 'Agama wajib diisi.',
            'kewarganegaraan.required' => 'Kewarganegaraan wajib diisi.',
            'status_pernikahan.required' => 'Status Pernikahan wajib diisi.',
            'dusun.required' => 'Dusun wajib diisi.',
            'rt.required' => 'RT wajib diisi.',
            'rw.required' => 'RW wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'pendidikan.required' => 'Pendidikan wajib diisi.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'kepemilikan_bpjs.required' => 'Kepemilikan BPJS wajib diisi.',
            'kepemilikan_e_ktp.required' => 'Kepemilikan E-KTP wajib diisi.',
            'nama_ibu.required' => 'Nama Ibu wajib diisi.',
            'nama_ayah.required' => 'Nama Ayah wajib diisi.',


        ];
    }
}
