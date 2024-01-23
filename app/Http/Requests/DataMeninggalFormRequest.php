<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataMeninggalFormRequest extends FormRequest
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
            'NIK_penduduk' => 'required|string|max:255',
            'tgl_meninggal' => 'required|date',
            'sebab' => 'required|string|max:255',
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
            'NIK_penduduk.required' => 'Nomor Induk Kependudukan (NIK) penduduk harus diisi.',
            'tgl_meninggal.required' => 'Tanggal meninggal harus diisi.',
            'tgl_meninggal.date' => 'Format tanggal meninggal tidak valid.',
            'sebab.required' => 'Sebab meninggal harus diisi.',
        ];
    }
}
