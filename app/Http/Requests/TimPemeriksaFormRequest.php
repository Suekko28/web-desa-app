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
            'nama_ketua.required' => 'Nama wajib diisi.',
            'jabatan_ketua.required' => 'Jabatan wajib diisi.',
            'tgl_pemeriksa.required' => 'Tanggal Pemeriksaan wajib diisi.',
            'tgl_pemeriksa.date' => 'Format tanggal pemeriksaan tidak valid.',
            'nomor.required' => 'Nomor wajib diisi.',
            'tahun.required' => 'Tahun wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'nama.*.required' => 'Nama Anggota Tim Pemeriksa wajib diisi.',
            'nama.*.string' => 'Nama Anggota Tim Pemeriksa harus berupa teks.',
            'jabatan.*.required' => 'Jabatan Anggota Tim Pemeriksa wajib diisi.',
            'jabatan.*.string' => 'Jabatan Anggota Tim Pemeriksa harus berupa teks.',
        ];
    }
}
