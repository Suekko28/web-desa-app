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
            'no_pesanan_brg' => 'required|string|max:255',
            'no_berita_acara' => 'required|string|max:255',
            'nama_pelaksana_kegiatan' => 'required|string|max:255',
            'sk_tpk' => 'required|string|max:255',
            'nama_rincian_spp' => 'required|string|max:255',
            'uraian_kwitansi' => 'required|string|max:255',
            'tgl_pesanan' => 'required|date',
            'tgl_bast' => 'required|date',
            'jatuh_tempo' => 'required|date',
            'jatuh_pemeriksaan' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'nama_toko' => 'required|string|max:255',
            'pemilik_toko' => 'required|string|max:255',
            'lampiran' => 'required|string|max:255',
            'tim_pemeriksa' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
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
            'no_pesanan_brg.required' => 'Nomor Pesanan Barang harus diisi.',
            'no_berita_acara.required' => 'Nomor Berita Acara harus diisi.',
            'nama_pelaksana_kegiatan.required' => 'Nama Pelaksana Kegiatan harus diisi.',
            'sk_tpk.required' => 'Surat Keputusan TPK harus diisi.',
            'nama_rincian_spp.required' => 'Nama Rincian SPP harus diisi.',
            'uraian_kwitansi.required' => 'Uraian Kwitansi harus diisi.',
            'tgl_pesanan.required' => 'Tanggal Pesanan harus diisi.',
            'tgl_pesanan.date' => 'Format tanggal Pesanan tidak valid.',
            'tgl_bast.required' => 'Tanggal BAST harus diisi.',
            'tgl_bast.date' => 'Format tanggal BAST tidak valid.',
            'jatuh_tempo.required' => 'Jatuh Tempo harus diisi.',
            'jatuh_tempo.date' => 'Format tanggal Jatuh Tempo tidak valid.',
            'jatuh_pemeriksaan.required' => 'Jatuh Pemeriksaan harus diisi.',
            'jatuh_pemeriksaan.date' => 'Format tanggal Jatuh Pemeriksaan tidak valid.',
            'keterangan.required' => 'Keterangan harus diisi.',
            'nama_toko.required' => 'Nama Toko harus diisi.',
            'pemilik_toko.required' => 'Pemilik Toko harus diisi.',
            'lampiran.required' => 'Lampiran harus diisi.',
            'tim_pemeriksa.required' => 'Tim Pemeriksa harus diisi.',
            'perihal.required' => 'Perihal harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
        ];
    }
}
