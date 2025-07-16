@extends('layouts.customer.master')

@section('content')
    <section id="single-product" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-image-wrapper">
                        @if ($hewan->gambar)
                            <img src="{{ Storage::url($hewan->gambar) }}" alt="{{ $hewan->nama }}"
                                class="img-fluid rounded-4 product-main-image">
                        @else
                            <img src="/placeholder.svg?height=500&width=500" alt="Placeholder Image"
                                class="img-fluid rounded-4 product-main-image">
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-details">
                        <h1 class="display-4 fw-normal mb-3">{{ $hewan->nama }}</h1>
                        <div class="d-flex align-items-center mb-3">
                            <span class="rating secondary-font me-2">
                                <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                5.0
                            </span>
                            <span class="text-muted">(120 Reviews)</span>
                        </div>
                        <h2 class="secondary-font text-primary mb-4">Rp {{ number_format($hewan->harga, 0, ',', '.') }}</h2>

                        <p class="fs-5 mb-4">{{ $hewan->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

                        <ul class="list-unstyled product-meta mb-4">
                            <li><strong>Ras:</strong> {{ $hewan->ras }}</li>
                            <li><strong>Jenis Kelamin:</strong> {{ ucfirst($hewan->jenis_kelamin) }}</li>
                            <li><strong>Umur:</strong> {{ $hewan->umur }} tahun</li>
                            <li><strong>Berat:</strong> {{ $hewan->berat ?? '-' }} kg</li>
                            <li><strong>Warna:</strong> {{ $hewan->warna ?? '-' }}</li>
                            <li><strong>Kategori:</strong> {{ $hewan->kategori->nama_kategori }}</li>
                            <li><strong>Status Kesehatan:</strong> {{ $hewan->status_kesehatan ?? '-' }}</li>
                            <li><strong>Sudah Vaksin:</strong> {{ $hewan->sudah_vaksin ? 'Ya' : 'Tidak' }}</li>
                            <li><strong>Stok:</strong> <span
                                    class="fw-bold {{ $hewan->stok > 0 ? 'text-success' : 'text-danger' }}">{{ $hewan->stok > 0 ? 'Tersedia (' . $hewan->stok . ')' : 'Habis' }}</span>
                            </li>
                        </ul>

                        <div class="d-flex align-items-center gap-3 mb-4">
                            <input type="number" class="form-control w-25" value="1" min="1"
                                max="{{ $hewan->stok }}">
                            <button class="btn btn-primary btn-lg text-uppercase fs-6 rounded-1"
                                {{ $hewan->stok == 0 ? 'disabled' : '' }}>
                                Add to Cart
                                <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                    <use xlink:href="#cart"></use>
                                </svg>
                            </button>
                            <a href="#" class="btn-wishlist px-4 pt-3 ">
                                <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                            </a>
                        </div>

                        <a href="{{ route('home') }}" class="btn btn-outline-secondary mt-3">
                            <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                <use xlink:href="#arrow-right"></use>
                            </svg>
                            Kembali ke Toko
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .product-main-image {
            max-height: 500px;
            object-fit: contain;
            width: 100%;
        }

        .product-meta li {
            margin-bottom: 0.5rem;
        }
    </style>
@endpush
