@extends('layouts.admin.master')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Edit Kategori Hewan</h3>
                <h6 class="op-7 mb-2">Formulir untuk mengedit kategori hewan</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Form Kategori Hewan</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kategori.update', ['kategori' => $kategori->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                                    id="nama_kategori" name="nama_kategori"
                                    value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                                @error('nama_kategori')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
