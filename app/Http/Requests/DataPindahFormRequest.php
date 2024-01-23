<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataPindahFormRequest extends FormRequest
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
            'NIK' => 'required|string|max:255',
            'tgl_pindah' => 'required|date',
            'alasan' => 'required|string|max:255',
            'alamat_pindah' => 'required|string|max:255',
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
            'NIK.required' => 'Nomor Induk Kependudukan (NIK) harus diisi.',
            'tgl_pindah.required' => 'Tanggal pindah harus diisi.',
            'tgl_pindah.date' => 'Format tanggal pindah tidak valid.',
            'alasan.required' => 'Alasan pindah harus diisi.',
            'alamat_pindah.required' => 'Alamat pindah harus diisi.',
        ];
    }
}
