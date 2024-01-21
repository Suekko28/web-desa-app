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
    public function rules(): array
    {
        return [
            'NIP' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tgl_pemeriksa' => 'required|date',
            'nomor' => 'required|string|max:255',
            'tahun' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
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
            'NIP.required' => 'NIP harus diisi.',
            'nama.required' => 'Nama harus diisi.',
            'jabatan.required' => 'Jabatan harus diisi.',
            'tgl_pemeriksa.required' => 'Tanggal pemeriksaan harus diisi.',
            'tgl_pemeriksa.date' => 'Format tanggal pemeriksaan tidak valid.',
            'nomor.required' => 'Nomor harus diisi.',
            'tahun.required' => 'Tahun harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
        ];
    }
}
