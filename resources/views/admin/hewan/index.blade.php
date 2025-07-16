@extends('layouts.admin.master')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Data Hewan</h3>
                <h6 class="op-7 mb-2">Manajemen data hewan peliharaan</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('hewan.create') }}" class="btn btn-primary btn-round">Tambah Hewan</a>
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
                            <div class="card-title">Daftar Hewan</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Nama</th>
                                        <th>Ras</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Umur</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hewans as $hewan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($hewan->gambar)
                                                    {{-- Cek jika ada gambar --}}
                                                    <img src="{{ Storage::url($hewan->gambar) }}" alt="{{ $hewan->nama }}"
                                                        width="50">
                                                @else
                                                    Tidak ada gambar
                                                @endif
                                            </td>
                                            <td>{{ $hewan->nama }}</td>
                                            <td>{{ $hewan->ras }}</td>
                                            <td>{{ ucfirst($hewan->jenis_kelamin) }}</td>
                                            <td>{{ $hewan->umur }} tahun</td>
                                            <td>Rp {{ number_format($hewan->harga, 0, ',', '.') }}</td>
                                            <td>{{ $hewan->stok }}</td>
                                            <td>{{ $hewan->kategori->nama_kategori }}</td>
                                            <td>
                                                <a href="{{ route('hewan.show', $hewan->id) }}"
                                                    class="btn btn-info btn-sm">Lihat</a>
                                                <a href="{{ route('hewan.edit', $hewan->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('hewan.destroy', $hewan->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data hewan ini?')">Hapus</button>
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
