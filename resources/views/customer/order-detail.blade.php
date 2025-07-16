@extends('layouts.customer.master')

@section('content')
    <section id="order-detail-page" class="py-5">
        <div class="container">
            <h1 class="display-4 fw-normal mb-4">Detail Pesanan #{{ $order->nomor_pesanan }}</h1>

            <div class="row">
                <div class="col-md-8">
                    <div class="card card-round mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Informasi Pesanan</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Nomor Pesanan:</strong> {{ $order->nomor_pesanan }}</p>
                            <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                            <p><strong>Status:</strong>
                                <span
                                    class="badge text-dark
                                    @if ($order->status == 'pending') bg-warning
                                    @elseif($order->status == 'diproses') bg-info
                                    @elseif($order->status == 'selesai') bg-success
                                    @else bg-danger @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                            <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>

                            <h5 class="mt-4">Alamat Pengiriman</h5>
                            <p>{{ $order->alamat_pengiriman }}</p>
                            <p>Telp: {{ $order->telepon_penerima }}</p>

                            <h5 class="mt-4">Detail Pembayaran</h5>
                            @if ($order->rekeningPembayaran)
                                <p><strong>Bank:</strong> {{ $order->rekeningPembayaran->nama_bank }}</p>
                                <p><strong>Nomor Rekening:</strong> {{ $order->rekeningPembayaran->nomor_rekening }}</p>
                                <p><strong>Nama Pemilik:</strong> {{ $order->rekeningPembayaran->nama_pemilik }}</p>
                            @else
                                <p>Informasi rekening pembayaran tidak tersedia.</p>
                            @endif

                            @if ($order->bukti_transfer)
                                <h5 class="mt-4">Bukti Transfer</h5>
                                <a href="{{ Storage::url($order->bukti_transfer) }}" target="_blank">
                                    <img src="{{ Storage::url($order->bukti_transfer) }}" alt="Bukti Transfer"
                                        class="img-fluid img-thumbnail" style="max-width: 200px;">
                                </a>
                                <p class="mt-2"><small class="text-muted">Klik gambar untuk melihat ukuran penuh.</small>
                                </p>
                            @else
                                <p>Tidak ada bukti transfer diunggah.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-round">
                        <div class="card-header">
                            <h5 class="card-title">Item Pesanan</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach ($order->orderItems as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            @if ($item->hewan->gambar)
                                                <img src="{{ Storage::url($item->hewan->gambar) }}"
                                                    alt="{{ $item->hewan->nama }}" width="50"
                                                    class="img-thumbnail me-2">
                                            @else
                                                <img src="/placeholder.svg?height=50&width=50" alt="Placeholder Image"
                                                    width="50" class="img-thumbnail me-2">
                                            @endif
                                            <div>
                                                {{ $item->hewan->nama }} (x{{ $item->jumlah }})
                                                <br>
                                                <small class="text-muted">Rp
                                                    {{ number_format($item->harga_satuan, 0, ',', '.') }} / item</small>
                                            </div>
                                        </div>
                                        <span>Rp
                                            {{ number_format($item->jumlah * $item->harga_satuan, 0, ',', '.') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('customer.orders.index') }}" class="btn btn-outline-secondary w-100">Kembali ke
                            Riwayat Pesanan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
