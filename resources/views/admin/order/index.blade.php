@extends('layouts.admin.master')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Manajemen Pesanan</h3>
                <h6 class="op-7 mb-2">Daftar semua pesanan pelanggan</h6>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Daftar Pesanan</div>
                            <div class="card-tools">
                                <form action="{{ route('orders.index') }}" method="GET" class="d-inline-block">
                                    <select name="status" class="form-control form-control-sm d-inline-block w-auto"
                                        onchange="this.form.submit()">
                                        <option value="">Semua Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>
                                            Diproses</option>
                                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>
                                            Selesai</option>
                                        <option value="dibatalkan"
                                            {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Pesanan</th>
                                        <th>Pelanggan</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        <th>Tanggal Pesan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->nomor_pesanan }}</td>
                                            <td>{{ $order->user->name }}</td>
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
                                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('orders.show', $order->id) }}"
                                                    class="btn btn-info btn-sm">Detail</a>
                                                @if ($order->status == 'pending')
                                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="diproses">
                                                        <button type="submit" class="btn btn-primary btn-sm"
                                                            onclick="return confirm('Ubah status menjadi Diproses?')">Proses</button>
                                                    </form>
                                                @elseif ($order->status == 'diproses')
                                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="selesai">
                                                        <button type="submit" class="btn btn-success btn-sm"
                                                            onclick="return confirm('Ubah status menjadi Selesai?')">Selesai</button>
                                                    </form>
                                                @endif
                                                @if ($order->status != 'selesai' && $order->status != 'dibatalkan')
                                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="dibatalkan">
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Batalkan pesanan ini?')">Batalkan</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada pesanan.</td>
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
    <script>
        $(document).ready(function() {
            $('#basic-datatables').DataTable({});
        });
    </script>
@endpush
