@extends('layouts.admin.master')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Detail Data Hewan</h3>
                <h6 class="op-7 mb-2">Informasi lengkap tentang hewan peliharaan</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Detail Hewan: {{ $hewan->nama }}</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nama:</strong> {{ $hewan->nama }}</p>
                                <p><strong>Ras:</strong> {{ $hewan->ras }}</p>
                                <p><strong>Jenis Kelamin:</strong> {{ ucfirst($hewan->jenis_kelamin) }}</p>
                                <p><strong>Umur:</strong> {{ $hewan->umur }} tahun</p>
                                <p><strong>Harga:</strong> Rp {{ number_format($hewan->harga, 0, ',', '.') }}</p>
                                <p><strong>Stok:</strong> {{ $hewan->stok }}</p>
                                <p><strong>Berat:</strong> {{ $hewan->berat ?? '-' }} kg</p>
                                <p><strong>Warna:</strong> {{ $hewan->warna ?? '-' }}</p>
                                <p><strong>Kategori:</strong> {{ $hewan->kategori->nama_kategori }}</p>
                                <p><strong>Pemasok:</strong> {{ $hewan->pemasok->nama_pemasok ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Deskripsi:</strong> {{ $hewan->deskripsi ?? '-' }}</p>
                                <p><strong>Status Kesehatan:</strong> {{ $hewan->status_kesehatan ?? '-' }}</p>
                                <p><strong>Sudah Vaksin:</strong> {{ $hewan->sudah_vaksin ? 'Ya' : 'Tidak' }}</p>

                                <h5 class="mt-4">Gambar Hewan:</h5>
                                @if ($hewan->gambar)
                                    {{-- Cek jika ada gambar --}}
                                    <img src="{{ Storage::url($hewan->gambar) }}" alt="{{ $hewan->nama }}"
                                        class="img-fluid img-thumbnail" style="max-width: 300px;">
                                @else
                                    <p>Tidak ada gambar yang tersedia.</p>
                                @endif
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('hewan.index') }}" class="btn btn-secondary">Kembali</a>
                            <a href="{{ route('hewan.edit', $hewan->id) }}" class="btn btn-warning">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
