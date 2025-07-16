@extends('layouts.customer.master')

@section('content')
    <section id="order-history-page" class="py-5">
        <div class="container">
            <h1 class="display-4 fw-normal mb-4">Riwayat Pesanan Anda</h1>

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

            @if ($orders->isEmpty())
                <div class="alert alert-info text-center" role="alert">
                    Anda belum memiliki riwayat pesanan. <a href="{{ route('home') }}" class="alert-link">Mulai belanja
                        sekarang!</a>
                </div>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-round">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nomor Pesanan</th>
                                                <th>Tanggal</th>
                                                <th>Total Harga</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $order->nomor_pesanan }}</td>
                                                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                                    <td>
                                                        <span
                                                            class="badge
                                                            @if ($order->status == 'pending') bg-warning
                                                            @elseif($order->status == 'diproses') bg-info
                                                            @elseif($order->status == 'selesai') bg-success
                                                            @else bg-danger @endif">
                                                            {{ ucfirst($order->status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('customer.orders.show', $order->id) }}"
                                                            class="btn btn-info btn-sm">Detail</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
