@extends('layouts.customer.master')

@section('content')
    <section id="banner" style="background: #F9F3EC;">
        <div class="container">
            <div class="swiper main-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide py-5">
                        <div class="row banner-content align-items-center">
                            <div class="img-wrapper col-md-5">
                                <img src="{{ URL::asset('assets/frontend') }}/images/banner-img.png" class="img-fluid">
                            </div>
                            <div class="content-wrapper col-md-7 p-5 mb-5">
                                <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                                <h2 class="banner-title display-1 fw-normal">Best destination for <span
                                        class="text-primary">your pets</span>
                                </h2>
                                <a href="{{ route('home', ['kategori_id' => '']) }}"
                                    class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                    shop now
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide py-5">
                        <div class="row banner-content align-items-center">
                            <div class="img-wrapper col-md-5">
                                <img src="{{ URL::asset('assets/frontend') }}/images//banner-img3.png" class="img-fluid">
                            </div>
                            <div class="content-wrapper col-md-7 p-5 mb-5">
                                <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                                <h2 class="banner-title display-1 fw-normal">Best destination for <span
                                        class="text-primary">your pets</span>
                                </h2>
                                <a href="{{ route('home', ['kategori_id' => '']) }}"
                                    class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                    shop now
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide py-5">
                        <div class="row banner-content align-items-center">
                            <div class="img-wrapper col-md-5">
                                <img src="{{ URL::asset('assets/frontend') }}/images/banner-img4.png" class="img-fluid">
                            </div>
                            <div class="content-wrapper col-md-7 p-5 mb-5">
                                <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                                <h2 class="banner-title display-1 fw-normal">Best destination for <span
                                        class="text-primary">your pets</span>
                                </h2>
                                <a href="{{ route('home', ['kategori_id' => '']) }}"
                                    class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                    shop now
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination mb-5"></div>
            </div>
        </div>
    </section>

    <section id="categories">
        <div class="container my-3 py-5">
            <div class="row my-5">
                <div class="col text-center">
                    <a href="{{ route('home', ['kategori_id' => '']) }}"
                        class="categories-item {{ !request()->has('kategori_id') || request()->kategori_id == '' ? 'active-category' : '' }}">
                        <iconify-icon class="category-icon" icon="ph:paw-print"></iconify-icon> {{-- Icon umum untuk semua --}}
                        <h5>Semua Hewan</h5>
                    </a>
                </div>
                @foreach ($kategori as $cat)
                    <div class="col text-center">
                        <a href="{{ route('home', ['kategori_id' => $cat->id]) }}"
                            class="categories-item {{ request('kategori_id') == $cat->id ? 'active-category' : '' }}">
                            {{-- Anda bisa menambahkan logika untuk icon berdasarkan nama kategori jika diinginkan --}}
                            <iconify-icon class="category-icon"
                                icon="ph:{{ strtolower(str_replace(' ', '-', $cat->nama_kategori)) }}"></iconify-icon>
                            <h5>{{ $cat->nama_kategori }}</h5>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="our-animals" class="my-5 overflow-hidden">
        <div class="container pb-5">
            <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
                <h2 class="display-3 fw-normal">Hewan Peliharaan Kami</h2>
                <div>
                    <a href="{{ route('home', ['kategori_id' => '']) }}"
                        class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                        Lihat Semua
                        <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                            <use xlink:href="#arrow-right"></use>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="products-carousel swiper">
                <div class="swiper-wrapper">
                    @forelse ($hewans as $hewan)
                        <div class="swiper-slide">
                            {{-- Anda bisa menambahkan label 'New' atau 'Sale' di sini jika ada logika status --}}
                            {{-- <div class="z-1 position-absolute rounded-3 m-3 px-3 border border-dark-subtle">
                                New
                            </div> --}}
                            <div class="card position-relative">
                                <a href="{{ route('hewan.customer.show', $hewan->id) }}">
                                    @if ($hewan->gambar)
                                        <img src="{{ Storage::url($hewan->gambar) }}" class="img-fluid rounded-4"
                                            alt="{{ $hewan->nama }}">
                                    @else
                                        <img src="/placeholder.svg?height=300&width=300" class="img-fluid rounded-4"
                                            alt="Placeholder Image">
                                    @endif
                                </a>
                                <div class="card-body p-0">
                                    <a href="{{ route('hewan.customer.show', $hewan->id) }}">
                                        <h3 class="card-title pt-4 m-0">{{ $hewan->nama }}</h3>
                                    </a>
                                    <div class="card-text">
                                        <span class="rating secondary-font">
                                            {{-- Rating statis, bisa diganti dengan rating dinamis jika ada --}}
                                            <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                            <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                            <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                            <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                            <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                            5.0
                                        </span>
                                        <h3 class="secondary-font text-primary">Rp
                                            {{ number_format($hewan->harga, 0, ',', '.') }}</h3>
                                        <div class="d-flex flex-wrap mt-3">
                                            <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                                                <h5 class="text-uppercase m-0">Add to Cart</h5>
                                            </a>
                                            <a href="#" class="btn-wishlist px-4 pt-3 ">
                                                <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>Tidak ada hewan yang tersedia untuk kategori ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <!-- / products-carousel -->
        </div>
    </section>

    <section id="banner-2" class="my-3" style="background: #F9F3EC;">
        <div class="container">
            <div class="row flex-row-reverse banner-content align-items-center">
                <div class="img-wrapper col-12 col-md-6">
                    <img src="{{ URL::asset('assets/frontend') }}/images/banner-img2.png" class="img-fluid">
                </div>
                <div class="content-wrapper col-12 offset-md-1 col-md-5 p-5">
                    <div class="secondary-font text-primary text-uppercase mb-3 fs-4">Upto 40% off</div>
                    <h2 class="banner-title display-1 fw-normal">Clearance sale !!!
                    </h2>
                    <a href="{{ route('home', ['kategori_id' => '']) }}"
                        class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                        shop now
                        <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                            <use xlink:href="#arrow-right"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="service">
        <div class="container py-5 my-5">
            <div class="row g-md-5 pt-4">
                <div class="col-md-3 my-3">
                    <div class="card">
                        <div>
                            <iconify-icon class="service-icon text-primary" icon="la:shopping-cart"></iconify-icon>
                        </div>
                        <h3 class="card-title py-2 m-0">Free Delivery</h3>
                        <div class="card-text">
                            <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 my-3">
                    <div class="card">
                        <div>
                            <iconify-icon class="service-icon text-primary" icon="la:user-check"></iconify-icon>
                        </div>
                        <h3 class="card-title py-2 m-0">100% secure payment</h3>
                        <div class="card-text">
                            <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 my-3">
                    <div class="card">
                        <div>
                            <iconify-icon class="service-icon text-primary" icon="la:tag"></iconify-icon>
                        </div>
                        <h3 class="card-title py-2 m-0">Daily Offer</h3>
                        <div class="card-text">
                            <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 my-3">
                    <div class="card">
                        <div>
                            <iconify-icon class="service-icon text-primary" icon="la:award"></iconify-icon>
                        </div>
                        <h3 class="card-title py-2 m-0">Quality guarantee</h3>
                        <div class="card-text">
                            <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="insta" class="my-5">
        <div class="row g-0 py-5">
            <div class="col instagram-item text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="{{ URL::asset('assets/frontend') }}/images/insta1.jpg" alt="insta-img"
                        class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="{{ URL::asset('assets/frontend') }}/images/insta2.jpg" alt="insta-img"
                        class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="{{ URL::asset('assets/frontend') }}/images/insta3.jpg" alt="insta-img"
                        class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="{{ URL::asset('assets/frontend') }}/images/insta4.jpg" alt="insta-img"
                        class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="{{ URL::asset('assets/frontend') }}/images/insta5.jpg" alt="insta-img"
                        class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col instagram-item text-center position-relative">
                <div class="icon-overlay d-flex justify-content-center position-absolute">
                    <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
                </div>
                <a href="#">
                    <img src="{{ URL::asset('assets/frontend') }}/images/insta6.jpg" alt="insta-img"
                        class="img-fluid rounded-3">
                </a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .categories-item.active-category {
            border: 2px solid #007bff;
            /* Contoh border biru untuk kategori aktif */
            border-radius: 8px;
            padding: 10px;
            background-color: #e9f5ff;
            /* Warna latar belakang ringan */
        }

        .categories-item {
            display: block;
            /* Memastikan seluruh area link bisa diklik */
            text-decoration: none;
            /* Menghilangkan garis bawah */
            color: inherit;
            /* Menggunakan warna teks default */
        }

        .categories-item:hover {
            background-color: #f0f0f0;
            /* Efek hover */
            border-radius: 8px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Inisialisasi Swiper untuk produk
        var productSwiper = new Swiper('.products-carousel', {
            slidesPerView: 1,
            spaceBetween: 20,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
            },
        });
    </script>
@endpush
