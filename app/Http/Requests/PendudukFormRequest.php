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
        ];


    }

    public function messages(): array
    {
        return [
            'tgl_pindah_masuk.required' => 'Tanggal Pindah Masuk harus diisi.',
            'tgl_lapor.required' => 'Tanggal Lapor harus diisi.',
            'NIK.required' => 'NIK harus diisi.',
            'NKK.required' => 'NKK harus diisi.',
            'nama.required' => 'Nama harus diisi.',
            'tempat_lahir.required' => 'Tempat Lahir harus diisi.',
            'tgl_lahir.required' => 'Tanggal Lahir harus diisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi.',
            'agama.required' => 'Agama harus diisi.',
            'kewarganegaraan.required' => 'Kewarganegaraan harus diisi.',
            'status_pernikahan.required' => 'Status Pernikahan harus diisi.',
            'dusun.required' => 'Dusun harus diisi.',
            'rt.required' => 'RT harus diisi.',
            'rw.required' => 'RW harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'pendidikan.required' => 'Pendidikan harus diisi.',
            'pekerjaan.required' => 'Pekerjaan harus diisi.',
            'kepemilikan_bpjs.required' => 'Kepemilikan BPJS harus diisi.',
            'kepemilikan_e_ktp.required' => 'Kepemilikan E-KTP harus diisi.',
            'nama_ibu.required' => 'Nama Ibu harus diisi.',
            'nama_ayah.required' => 'Nama Ayah harus diisi.',
        ];
    }
}
