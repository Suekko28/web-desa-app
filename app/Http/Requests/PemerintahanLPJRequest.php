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
            'no_pesanan_brg' => ['required', 'string', 'max:255'],
            'no_berita_acara' => ['required', 'string', 'max:255'],
            'nama_pelaksana_kegiatan' => ['required', 'string', 'max:255'],
            'sk_tpk' => ['required', 'string', 'max:255'],
            'nama_rincian_spp' => ['required', 'string', 'max:255'],
            'uraian_kwitansi' => ['required', 'string', 'max:255'],
            'tgl_pesanan' => ['required', 'date'],
            'jatuh_tempo' => ['required', 'date'],
            'tgl_bast' => ['required', 'date'],
            'jatuh_pemeriksaan' => ['required', 'date'],
            'keterangan' => ['required', 'string', 'max:255'],
            'nama_toko' => ['required', 'string', 'max:255'],
            'pemilik_toko' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
        ];
    }
    
    public function messages(): array
    {
        return [
            'no_pesanan_brg.required' => 'Nomor Pesanan Barang wajib diisi.',
            'no_berita_acara.required' => 'Nomor Berita Acara wajib diisi.',
            'nama_pelaksana_kegiatan.required' => 'Nama Pelaksana Kegiatan wajib diisi.',
            'sk_tpk.required' => 'SK TPK wajib diisi.',
            'nama_rincian_spp.required' => 'Nama Rincian SPP wajib diisi.',
            'uraian_kwitansi.required' => 'Uraian Kwitansi wajib diisi.',
            'tgl_pesanan.required' => 'Tanggal Pesanan wajib diisi.',
            'tgl_bast.required' => 'Tanggal BAST wajib diisi.',
            'jatuh_tempo.required' => 'Jatuh Tempo wajib diisi.',
            'jatuh_pemeriksaan.required' => 'Jatuh Pemeriksaan wajib diisi.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'nama_toko.required' => 'Nama Toko wajib diisi.',
            'pemilik_toko.required' => 'Pemilik Toko wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ];
    }
    }
