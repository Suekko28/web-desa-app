<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemerintahanLPJRequest extends FormRequest
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
            'no_pesanan_brg' => 'required|string|max:100',
            'no_berita_acara' => 'required|string|max:100',
            'no_berita_acara_pemeriksaan' => 'required|string|max:100',
            'dana_desa' => 'required|string|max:100',
            'nama_pelaksana_kegiatan' => 'required|string|max:100',
            'sk_tpk' => 'required|string|max:100',
            'nama_rincian_spp' => 'required|string|max:100',
            'uraian_kwitansi' => 'required|string|max:100',
            'tgl_pesanan' => 'required|date',
            'tgl_bast' => 'required|date',
            'jatuh_tempo' => 'required|date',
            'jatuh_pemeriksaan' => 'required|date',
            'keterangan' => 'required|string|max:100',
            'nama_toko' => 'required|string|max:100',
            'pemilik_toko' => 'required|string|max:100',
            'lampiran' => 'required|string|max:100',
            'timpemeriksa_id' => 'required|exists:lpj_timpemeriksa,id',
            'perihal' => 'required|string|max:100',
            'alamat' => 'required|string|max:100',
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
            'no_pesanan_brg.required' => 'Nomor Pesanan Barang harus diisi.',
            'no_pesanan_brg.max' => 'Nomor Pesanan Barang tidak boleh lebih dari 100 karakter.',

            'no_berita_acara.required' => 'Nomor Berita Acara harus diisi.',
            'no_berita_acara.max' => 'Nomor Berita Acara tidak boleh lebih dari 100 karakter.',

            'no_berita_acara_pemeriksaan.required' => 'Nomor Berita Acara Pemeriksaan harus diisi.',
            'no_berita_acara_pemeriksaan.max' => 'Nomor Berita Acara Pemeriksaan tidak boleh lebih dari 100 karakter.',

            'dana_desa.required' => 'Sumber Dana Desa harus diisi.',
            'dana_desa.max' => 'Sumber Dana Desa tidak boleh lebih dari 100 karakter.',

            'nama_pelaksana_kegiatan.required' => 'Nama Pelaksana Kegiatan harus diisi.',
            'nama_pelaksana_kegiatan.max' => 'Nama Pelaksana Kegiatan tidak boleh lebih dari 100 karakter.',

            'sk_tpk.required' => 'Surat Keputusan TPK harus diisi.',
            'sk_tpk.max' => 'Surat Keputusan TPK tidak boleh lebih dari 100 karakter.',

            'nama_rincian_spp.required' => 'Nama Rincian SPP harus diisi.',
            'nama_rincian_spp.max' => 'Nama Rincian SPP tidak boleh lebih dari 100 karakter.',

            'uraian_kwitansi.required' => 'Uraian Kwitansi harus diisi.',
            'uraian_kwitansi.max' => 'Uraian Kwitansi tidak boleh lebih dari 100 karakter.',

            'tgl_pesanan.required' => 'Tanggal Pesanan harus diisi.',
            'tgl_pesanan.date' => 'Format tanggal Pesanan tidak valid.',

            'tgl_bast.required' => 'Tanggal BAST harus diisi.',
            'tgl_bast.date' => 'Format tanggal BAST tidak valid.',

            'jatuh_tempo.required' => 'Jatuh Tempo harus diisi.',
            'jatuh_tempo.date' => 'Format tanggal Jatuh Tempo tidak valid.',

            'jatuh_pemeriksaan.required' => 'Jatuh Pemeriksaan harus diisi.',
            'jatuh_pemeriksaan.date' => 'Format tanggal Jatuh Pemeriksaan tidak valid.',

            'keterangan.required' => 'Keterangan harus diisi.',
            'keterangan.max' => 'Keterangan tidak boleh lebih dari 100 karakter.',

            'nama_toko.required' => 'Nama Toko harus diisi.',
            'nama_toko.max' => 'Nama Toko tidak boleh lebih dari 100 karakter.',

            'pemilik_toko.required' => 'Pemilik Toko harus diisi.',
            'pemilik_toko.max' => 'Pemilik Toko tidak boleh lebih dari 100 karakter.',

            'lampiran.required' => 'Lampiran harus diisi.',
            'lampiran.max' => 'Lampiran tidak boleh lebih dari 100 karakter.',

            'timpemeriksa_id.required' => 'Tim Pemeriksa harus diisi.',
            'timpemeriksa_id.exists' => 'Tim Pemeriksa yang dipilih tidak valid.',

            'perihal.required' => 'Perihal harus diisi.',
            'perihal.max' => 'Perihal tidak boleh lebih dari 100 karakter.',

            'alamat.required' => 'Alamat harus diisi.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 100 karakter.',
        ];
    }
}
