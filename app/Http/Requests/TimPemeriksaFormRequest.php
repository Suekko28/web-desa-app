<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimPemeriksaFormRequest extends FormRequest
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
    public function rules()
    {
        return [
            'NIP' => 'required',
            'nama_ketua' => 'required',
            'jabatan_ketua' => 'required',
            'tgl_pemeriksa' => 'required|date',
            'nomor' => 'required',
            'tahun' => 'required',
            'alamat' => 'required',
            'nama.*' => 'sometimes|required|string',
            'jabatan.*' => 'sometimes|required|string',
        ];
    }

    public function messages()
    {
        return [
            'NIP.required' => 'NIP wajib diisi.',
            'NIP.max' => 'NIP maksimal 100 karakter.',
            'nama_ketua.required' => 'Nama Ketua wajib diisi.',
            'nama_ketua.max' => 'Nama Ketua maksimal 100 karakter.',
            'jabatan_ketua.required' => 'Jabatan Ketua wajib diisi.',
            'jabatan_ketua.max' => 'Jabatan Ketua maksimal 100 karakter.',
            'tgl_pemeriksa.required' => 'Tanggal Pemeriksaan wajib diisi.',
            'tgl_pemeriksa.date' => 'Format tanggal pemeriksaan tidak valid.',
            'nomor.required' => 'Nomor wajib diisi.',
            'nomor.max' => 'Nomor maksimal 100 karakter.',
            'tahun.required' => 'Tahun wajib diisi.',
            'tahun.max' => 'Tahun maksimal 100 karakter.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',

            // Messages for dynamic fields (array inputs)
            'nama.*.required' => 'Nama Anggota Tim Pemeriksa wajib diisi.',
            'nama.*.string' => 'Nama Anggota Tim Pemeriksa harus berupa teks.',
            'nama.*.max' => 'Nama Anggota Tim Pemeriksa maksimal 100 karakter.',
            'jabatan.*.required' => 'Jabatan Anggota Tim Pemeriksa wajib diisi.',
            'jabatan.*.string' => 'Jabatan Anggota Tim Pemeriksa harus berupa teks.',
            'jabatan.*.max' => 'Jabatan Anggota Tim Pemeriksa maksimal 100 karakter.',
        ];
    }
}
