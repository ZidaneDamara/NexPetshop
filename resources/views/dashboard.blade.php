@extends('layouts.admin.master')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard Admin</h3>
                <h6 class="op-7 mb-2">Ringkasan Statistik Toko Anda</h6>
            </div>
            {{-- Hapus tombol "Manage" dan "Add Customer" jika tidak relevan dengan ringkasan dashboard --}}
            {{-- <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
                <a href="#" class="btn btn-primary btn-round">Add Customer</a>
            </div> --}}
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Pelanggan</p>
                                    <h4 class="card-title">{{ $totalCustomers }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-paw"></i> {{-- Mengganti icon --}}
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Hewan</p>
                                    <h4 class="card-title">{{ $totalAnimals }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-dollar-sign"></i> {{-- Mengganti icon --}}
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Penjualan</p>
                                    <h4 class="card-title">Rp {{ number_format($totalSales, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="fas fa-hourglass-half"></i> {{-- Mengganti icon --}}
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Pesanan Pending</p>
                                    <h4 class="card-title">{{ $pendingOrders }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Pelanggan Terbaru</div>
                            {{-- <div class="card-tools">
                                <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                                    <span class="btn-label">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    Export
                                </a>
                                <a href="#" class="btn btn-label-info btn-round btn-sm">
                                    <span class="btn-label">
                                        <i class="fa fa-print"></i>
                                    </span>
                                    Print
                                </a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-list py-4">
                            @forelse ($recentCustomers as $customer)
                                <div class="item-list">
                                    <div class="avatar">
                                        {{-- Anda bisa menambahkan gambar profil jika ada, atau inisial --}}
                                        <span
                                            class="avatar-title rounded-circle border border-white bg-primary">{{ substr($customer->name, 0, 1) }}</span>
                                    </div>
                                    <div class="info-user ms-3">
                                        <div class="username">{{ $customer->name }}</div>
                                        <div class="status">{{ $customer->email }}</div>
                                    </div>
                                    {{-- Hapus tombol email dan ban jika tidak diperlukan di sini --}}
                                    {{-- <button class="btn btn-icon btn-link op-8 me-1">
                                        <i class="far fa-envelope"></i>
                                    </button>
                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                        <i class="fas fa-ban"></i>
                                    </button> --}}
                                </div>
                            @empty
                                <p class="text-center">Tidak ada pelanggan baru.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Riwayat Transaksi Terbaru</div>
                            {{-- <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-label-light dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Export
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Nomor Pesanan</th>
                                        <th scope="col">Pelanggan</th>
                                        <th scope="col" class="text-end">Jumlah</th>
                                        <th scope="col" class="text-end">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentOrders as $order)
                                        <tr>
                                            <td>
                                                <a href="{{ route('orders.show', $order->id) }}"
                                                    class="btn btn-icon btn-round btn-info btn-sm me-2">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                {{ $order->nomor_pesanan }}
                                            </td>
                                            <td>{{ $order->user->name }}</td>
                                            <td class="text-end">Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end">
                                                <span
                                                    class="badge
                                                    @if ($order->status == 'pending') bg-warning
                                                    @elseif($order->status == 'diproses') bg-info
                                                    @elseif($order->status == 'selesai') bg-success
                                                    @else bg-danger @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada transaksi terbaru.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('scripts')
@endpush
