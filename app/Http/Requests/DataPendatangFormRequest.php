<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataPendatangFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'NIK' => 'required|string|max:255|unique:sirkulasi_pendatang',
            'jenis_kelamin' => 'required|int',
            'tgl_datang' => 'required|date',
            'alamat_sblm' => 'required|string|max:255',
            'alamat_skrg' => 'required|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama harus diisi.',
            'NIK.required' => 'Nomor Induk Kependudukan (NIK) harus diisi.',
            'NIK.unique' => 'Nomor Induk Kependudukan (NIK) sudah terdaftar',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin harus berupa "Laki-laki" atau "Perempuan".',
            'tgl_datang.required' => 'Tanggal datang harus diisi.',
            'tgl_datang.date' => 'Format tanggal datang tidak valid.',
            'alamat_sblm.required' => 'Alamat sebelumnya harus diisi.',
            'alamat_skrg.required' => 'Alamat sekarang harus diisi.',
        ];
    }
}
