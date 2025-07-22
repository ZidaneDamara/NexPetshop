@extends('layouts.admin.master')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Riwayat Mutasi Stok</h3>
                <h6 class="op-7 mb-2">Catatan keluar masuknya stok hewan</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Daftar Mutasi Stok</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Hewan</th>
                                        <th>Jumlah</th>
                                        <th>Tipe Mutasi</th>
                                        <th>Referensi</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mutasis as $mutasi)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $mutasi->created_at->format('d M Y H:i') }}</td>
                                            <td>{{ $mutasi->hewan->nama ?? 'Hewan Dihapus' }}</td>
                                            <td>{{ $mutasi->jumlah }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $mutasi->tipe_mutasi == 'masuk' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ ucfirst($mutasi->tipe_mutasi) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($mutasi->referensi_type == 'App\Models\Order' && $mutasi->referensi)
                                                    <a href="{{ route('orders.show', $mutasi->referensi_id) }}">Pesanan
                                                        #{{ $mutasi->referensi->nomor_pesanan }}</a>
                                                @elseif ($mutasi->referensi_type == 'App\Models\Hewan' && $mutasi->referensi)
                                                    <a href="{{ route('hewan.show', $mutasi->referensi_id) }}">Hewan:
                                                        {{ $mutasi->referensi->nama }}</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $mutasi->deskripsi ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada riwayat mutasi stok.</td>
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
