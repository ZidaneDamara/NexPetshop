@extends('layouts.admin.master')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Edit Rekening Pembayaran</h3>
                <h6 class="op-7 mb-2">Formulir untuk mengedit rekening pembayaran</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Form Rekening Pembayaran</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('rekening-pembayaran.update', $rekening_pembayaran->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama_bank" class="form-label">Nama Bank</label>
                                <input type="text" class="form-control @error('nama_bank') is-invalid @enderror"
                                    id="nama_bank" name="nama_bank"
                                    value="{{ old('nama_bank', $rekening_pembayaran->nama_bank) }}" required>
                                @error('nama_bank')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama_pemilik" class="form-label">Nama Pemilik Rekening</label>
                                <input type="text" class="form-control @error('nama_pemilik') is-invalid @enderror"
                                    id="nama_pemilik" name="nama_pemilik"
                                    value="{{ old('nama_pemilik', $rekening_pembayaran->nama_pemilik) }}" required>
                                @error('nama_pemilik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nomor_rekening" class="form-label">Nomor Rekening</label>
                                <input type="text" class="form-control @error('nomor_rekening') is-invalid @enderror"
                                    id="nomor_rekening" name="nomor_rekening"
                                    value="{{ old('nomor_rekening', $rekening_pembayaran->nomor_rekening) }}" required>
                                @error('nomor_rekening')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="logo" class="form-label">Logo Bank</label>
                                <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                    id="logo" name="logo" accept="image/*">
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($rekening_pembayaran->logo)
                                    <div class="mt-2">
                                        <h6>Logo Saat Ini:</h6>
                                        <img src="{{ Storage::url($rekening_pembayaran->logo) }}" alt="Logo Bank"
                                            width="100" class="img-thumbnail">
                                        <small class="text-muted">Unggah logo baru untuk mengganti yang sudah ada.</small>
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status"
                                    name="status" required>
                                    <option value="aktif"
                                        {{ old('status', $rekening_pembayaran->status) == 'aktif' ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="non-aktif"
                                        {{ old('status', $rekening_pembayaran->status) == 'non-aktif' ? 'selected' : '' }}>
                                        Non-Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                            <a href="{{ route('rekening-pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
