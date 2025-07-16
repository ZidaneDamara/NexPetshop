@extends('layouts.customer.master')

@section('content')
    <section id="checkout-success-page" class="py-5 text-center">
        <div class="container">
            <div class="card card-round p-5 mx-auto" style="max-width: 700px;">
                <div class="card-body">
                    <iconify-icon icon="mdi:check-circle-outline" style="font-size: 100px; color: green;"></iconify-icon>
                    <h1 class="display-4 fw-normal mt-3 mb-3">Pesanan Berhasil Dibuat!</h1>
                    <p class="lead">Terima kasih atas pesanan Anda. Pesanan Anda dengan nomor
                        **{{ $order->nomor_pesanan }}** telah berhasil kami terima dan sedang menunggu konfirmasi
                        pembayaran.</p>

                    <h5 class="mt-4 mb-3">Detail Pesanan Anda:</h5>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Nomor Pesanan: <span>{{ $order->nomor_pesanan }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Harga: <span>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Status: <span class="badge text-dark bg-warning">{{ ucfirst($order->status) }}</span>
                        </li>
                        <li class="list-group-item text-start">
                            <strong>Alamat Pengiriman:</strong><br>
                            {{ $order->alamat_pengiriman }}<br>
                            Telp: {{ $order->telepon_penerima }}
                        </li>
                        @if ($order->rekeningPembayaran)
                            <li class="list-group-item text-start">
                                <strong>Pembayaran ke:</strong><br>
                                {{ $order->rekeningPembayaran->nama_bank }} -
                                {{ $order->rekeningPembayaran->nomor_rekening }} (a.n.
                                {{ $order->rekeningPembayaran->nama_pemilik }})
                            </li>
                        @endif
                    </ul>

                    <p>Kami akan segera memproses pesanan Anda setelah pembayaran dikonfirmasi.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary btn-lg mt-3">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </section>
@endsection
