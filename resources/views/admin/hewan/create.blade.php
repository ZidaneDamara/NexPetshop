@extends('layouts.admin.master')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Tambah Data Hewan</h3>
                <h6 class="op-7 mb-2">Formulir untuk menambahkan data hewan baru</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Form Data Hewan</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('hewan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Hewan</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="ras" class="form-label">Ras</label>
                                        <input type="text" class="form-control @error('ras') is-invalid @enderror"
                                            id="ras" name="ras" value="{{ old('ras') }}" required>
                                        @error('ras')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                            id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="jantan" {{ old('jenis_kelamin') == 'jantan' ? 'selected' : '' }}>
                                                Jantan</option>
                                            <option value="betina" {{ old('jenis_kelamin') == 'betina' ? 'selected' : '' }}>
                                                Betina</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="umur" class="form-label">Umur (tahun)</label>
                                        <input type="number" class="form-control @error('umur') is-invalid @enderror"
                                            id="umur" name="umur" value="{{ old('umur') }}" required
                                            min="0">
                                        @error('umur')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                            id="harga" name="harga" value="{{ old('harga') }}" required
                                            min="0">
                                        @error('harga')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="stok" class="form-label">Stok</label>
                                        <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                            id="stok" name="stok" value="{{ old('stok') }}" required
                                            min="0">
                                        @error('stok')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="status_kesehatan" class="form-label">Status Kesehatan</label>
                                        <textarea class="form-control @error('status_kesehatan') is-invalid @enderror" id="status_kesehatan"
                                            name="status_kesehatan" rows="3">{{ old('status_kesehatan') }}</textarea>
                                        @error('status_kesehatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox"
                                            class="form-check-input @error('sudah_vaksin') is-invalid @enderror"
                                            id="sudah_vaksin" name="sudah_vaksin" value="1"
                                            {{ old('sudah_vaksin') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sudah_vaksin">Sudah Vaksin</label>
                                        @error('sudah_vaksin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="berat" class="form-label">Berat (kg)</label>
                                        <input type="number" step="0.1"
                                            class="form-control @error('berat') is-invalid @enderror" id="berat"
                                            name="berat" value="{{ old('berat') }}" min="0">
                                        @error('berat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="warna" class="form-label">Warna</label>
                                        <input type="text" class="form-control @error('warna') is-invalid @enderror"
                                            id="warna" name="warna" value="{{ old('warna') }}">
                                        @error('warna')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategori_hewan_id" class="form-label">Kategori Hewan</label>
                                        <select class="form-control @error('kategori_hewan_id') is-invalid @enderror"
                                            id="kategori_hewan_id" name="kategori_hewan_id" required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($kategori as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ old('kategori_hewan_id') == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori_hewan_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="pemasok_id" class="form-label">Pemasok Hewan</label>
                                        <select class="form-control @error('pemasok_id') is-invalid @enderror"
                                            id="pemasok_id" name="pemasok_id">
                                            <option value="">Pilih Pemasok (Opsional)</option>
                                            @foreach ($pemasoks as $pemasok)
                                                <option value="{{ $pemasok->id }}"
                                                    {{ old('pemasok_id') == $pemasok->id ? 'selected' : '' }}>
                                                    {{ $pemasok->nama_pemasok }}</option>
                                            @endforeach
                                        </select>
                                        @error('pemasok_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="gambar" class="form-label">Gambar</label>
                                        <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                            id="gambar" name="gambar" accept="image/*">
                                        @error('gambar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('hewan.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
