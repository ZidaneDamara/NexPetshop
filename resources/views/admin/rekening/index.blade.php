@extends('layouts.admin.master')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Daftar Rekening Pembayaran</h3>
                <h6 class="op-7 mb-2">Manajemen data rekening pembayaran</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('rekening-pembayaran.create') }}" class="btn btn-primary btn-round">Tambah Rekening</a>
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
                            <div class="card-title">Data Rekening Pembayaran</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Bank</th>
                                        <th>Nama Pemilik</th>
                                        <th>Nomor Rekening</th>
                                        <th>Logo</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rekenings as $rekening)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rekening->nama_bank }}</td>
                                            <td>{{ $rekening->nama_pemilik }}</td>
                                            <td>{{ $rekening->nomor_rekening }}</td>
                                            <td>
                                                @if ($rekening->logo)
                                                    <img src="{{ Storage::url($rekening->logo) }}" alt="Logo Bank"
                                                        width="50">
                                                @else
                                                    Tidak ada logo
                                                @endif
                                            </td>
                                            <td>
                                                <span
                                                    class="badge {{ $rekening->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ ucfirst($rekening->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('rekening-pembayaran.edit', $rekening->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('rekening-pembayaran.destroy', $rekening->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus rekening ini?')">Hapus</button>
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
