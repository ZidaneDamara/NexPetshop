@extends('layouts.customer.master')

@section('content')
    <section id="cart-page" class="py-5">
        <div class="container">
            <h1 class="display-4 fw-normal mb-4">Keranjang Belanja Anda</h1>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($keranjangItems->isEmpty())
                <div class="alert alert-info text-center" role="alert">
                    Keranjang Anda kosong. <a href="{{ route('home') }}" class="alert-link">Mulai belanja sekarang!</a>
                </div>
            @else
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-round">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Produk</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Subtotal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($keranjangItems as $item)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if ($item->hewan->gambar)
                                                                <img src="{{ Storage::url($item->hewan->gambar) }}"
                                                                    alt="{{ $item->hewan->nama }}" width="80"
                                                                    class="img-thumbnail me-3">
                                                            @else
                                                                <img src="/placeholder.svg?height=80&width=80"
                                                                    alt="Placeholder Image" width="80"
                                                                    class="img-thumbnail me-3">
                                                            @endif
                                                            <a
                                                                href="{{ route('hewan.customer.show', $item->hewan->id) }}">{{ $item->hewan->nama }}</a>
                                                        </div>
                                                    </td>
                                                    <td>Rp {{ number_format($item->hewan->harga, 0, ',', '.') }}</td>
                                                    <td>
                                                        <form action="{{ route('keranjang.update', $item->id) }}"
                                                            method="POST" class="d-flex align-items-center">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="number" name="jumlah" value="{{ $item->jumlah }}"
                                                                min="1" max="{{ $item->hewan->stok }}"
                                                                class="form-control w-50 me-2">
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-primary">Update</button>
                                                        </form>
                                                    </td>
                                                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                                    <td>
                                                        <form action="{{ route('keranjang.destroy', $item->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Hapus item ini dari keranjang?')">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-round">
                            <div class="card-header">
                                <h5 class="card-title">Ringkasan Keranjang</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Total Item
                                        <span
                                            class="badge bg-primary rounded-pill">{{ $keranjangItems->sum('jumlah') }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                        Total Harga
                                        <span>Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                                    </li>
                                </ul>
                                <div class="d-grid gap-2 mt-4">
                                    <a href="#" class="btn btn-primary btn-lg">Lanjutkan ke Checkout</a>
                                    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg">Lanjutkan
                                        Belanja</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
