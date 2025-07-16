@extends('layouts.customer.master')

@section('content')
    <section id="checkout-page" class="py-5">
        <div class="container">
            <h1 class="display-4 fw-normal mb-4">Checkout Pesanan</h1>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-8">
                    <div class="card card-round mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Detail Pengiriman</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="alamat_pengiriman" class="form-label">Alamat Pengiriman Lengkap</label>
                                    <textarea class="form-control @error('alamat_pengiriman') is-invalid @enderror" id="alamat_pengiriman"
                                        name="alamat_pengiriman" rows="4" required>{{ old('alamat_pengiriman', $user->address ?? '') }}</textarea>
                                    @error('alamat_pengiriman')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="telepon_penerima" class="form-label">Nomor Telepon Penerima</label>
                                    <input type="text"
                                        class="form-control @error('telepon_penerima') is-invalid @enderror"
                                        id="telepon_penerima" name="telepon_penerima"
                                        value="{{ old('telepon_penerima', $user->phone ?? '') }}" required>
                                    @error('telepon_penerima')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        </div>
                    </div>

                    <div class="card card-round mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Metode Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="rekening_pembayaran_id" class="form-label">Pilih Rekening Pembayaran</label>
                                <select class="form-control @error('rekening_pembayaran_id') is-invalid @enderror"
                                    id="rekening_pembayaran_id" name="rekening_pembayaran_id" required>
                                    <option value="">Pilih Rekening</option>
                                    @foreach ($rekeningPembayaran as $rekening)
                                        <option value="{{ $rekening->id }}"
                                            {{ old('rekening_pembayaran_id') == $rekening->id ? 'selected' : '' }}>
                                            {{ $rekening->nama_bank }} - {{ $rekening->nomor_rekening }} (a.n.
                                            {{ $rekening->nama_pemilik }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('rekening_pembayaran_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bukti_transfer" class="form-label">Unggah Bukti Transfer</label>
                                <input type="file" class="form-control @error('bukti_transfer') is-invalid @enderror"
                                    id="bukti_transfer" name="bukti_transfer" accept="image/*" required>
                                @error('bukti_transfer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Unggah gambar bukti transfer Anda (JPG, JPEG, PNG, maks
                                    2MB).</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-round">
                        <div class="card-header">
                            <h5 class="card-title">Ringkasan Pesanan</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush mb-3">
                                @foreach ($keranjangItems as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $item->hewan->nama }} (x{{ $item->jumlah }})
                                        <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                    </li>
                                @endforeach
                                <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                    Total Harga
                                    <span>Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                                </li>
                            </ul>
                            <button type="submit" class="btn btn-primary btn-lg w-100">Buat Pesanan</button>
                            </form> {{-- Form ends here --}}
                            <a href="{{ route('keranjang.index') }}"
                                class="btn btn-outline-secondary btn-lg w-100 mt-2">Kembali ke Keranjang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
