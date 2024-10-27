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
            'NIK' => ['required', 'string', 'max:100'],
            'NKK' => ['required', 'string', 'max:100'],
            'nama' => ['required', 'string', 'max:100'],
            'tempat_lahir' => ['required', 'string', 'max:100'],
            'tgl_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'integer'],
            'agama' => ['required', 'integer'],
            'kewarganegaraan' => ['required', 'integer'],
            'status_pernikahan' => ['required', 'integer'],
            'dusun' => ['required', 'string', 'max:100'],
            'rt' => ['required', 'string', 'max:10'],
            'rw' => ['required', 'string', 'max:10'],
            'alamat' => ['required', 'string', 'max:100'],
            'pendidikan' => ['required', 'integer'],
            'pekerjaan' => ['required', 'integer'],
            'kepemilikan_bpjs' => ['required', 'integer'],
            'kepemilikan_e_ktp' => ['required', 'integer'],
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
            'NIK.max' => 'NIK maksimal 100 karakter.',
            'NKK.required' => 'NKK wajib diisi.',
            'NKK.max' => 'NKK maksimal 100 karakter.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 100 karakter.',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi.',
            'tempat_lahir.max' => 'Tempat Lahir maksimal 100 karakter.',
            'tgl_lahir.required' => 'Tanggal Lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi.',
            'agama.required' => 'Agama wajib diisi.',
            'kewarganegaraan.required' => 'Kewarganegaraan wajib diisi.',
            'status_pernikahan.required' => 'Status Pernikahan wajib diisi.',
            'dusun.required' => 'Dusun wajib diisi.',
            'dusun.max' => 'Dusun maksimal 100 karakter.',
            'rt.required' => 'RT wajib diisi.',
            'rt.max' => 'RT maksimal 10 karakter.',
            'rw.required' => 'RW wajib diisi.',
            'rw.max' => 'RW maksimal 10 karakter.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.max' => 'Alamat maksimal 100 karakter.',
            'pendidikan.required' => 'Pendidikan wajib diisi.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'kepemilikan_bpjs.required' => 'Kepemilikan BPJS wajib diisi.',
            'kepemilikan_e_ktp.required' => 'Kepemilikan E-KTP wajib diisi.',
            'nama_ibu.required' => 'Nama Ibu wajib diisi.',
            'nama_ibu.max' => 'Nama Ibu maksimal 100 karakter.',
            'nama_ayah.required' => 'Nama Ayah wajib diisi.',
            'nama_ayah.max' => 'Nama Ayah maksimal 100 karakter.',
        ];
    }
}
