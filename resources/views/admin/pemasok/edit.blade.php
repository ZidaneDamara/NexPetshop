@extends('layouts.admin.master')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Edit Pemasok</h3>
                <h6 class="op-7 mb-2">Formulir untuk mengedit data pemasok</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Form Pemasok</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pemasok.update', $pemasok->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama_pemasok" class="form-label">Nama Pemasok</label>
                                <input type="text" class="form-control @error('nama_pemasok') is-invalid @enderror"
                                    id="nama_pemasok" name="nama_pemasok"
                                    value="{{ old('nama_pemasok', $pemasok->nama_pemasok) }}" required>
                                @error('nama_pemasok')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat', $pemasok->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                    id="telepon" name="telepon" value="{{ old('telepon', $pemasok->telepon) }}">
                                @error('telepon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                            <a href="{{ route('pemasok.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
