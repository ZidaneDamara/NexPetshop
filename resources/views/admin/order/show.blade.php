@extends('layouts.admin.master')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Detail Pesanan</h3>
                <h6 class="op-7 mb-2">Informasi lengkap tentang pesanan {{ $order->nomor_pesanan }}</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Pesanan #{{ $order->nomor_pesanan }}</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Informasi Pelanggan</h5>
                                <p><strong>Nama:</strong> {{ $order->user->name }}</p>
                                <p><strong>Email:</strong> {{ $order->user->email }}</p>
                                <p><strong>Telepon Penerima:</strong> {{ $order->telepon_penerima }}</p>
                                <p><strong>Alamat Pengiriman:</strong> {{ $order->alamat_pengiriman }}</p>

                                <h5 class="mt-4">Detail Pembayaran</h5>
                                <p><strong>Metode Pembayaran:</strong>
                                    @if ($order->rekeningPembayaran)
                                        {{ $order->rekeningPembayaran->nama_bank }}
                                        ({{ $order->rekeningPembayaran->nomor_rekening }}) a.n.
                                        {{ $order->rekeningPembayaran->nama_pemilik }}
                                    @else
                                        Rekening tidak ditemukan
                                    @endif
                                </p>
                                <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                </p>
                                <p><strong>Status:</strong>
                                    <span
                                        class="badge
                                      @if ($order->status == 'pending') bg-warning
                                      @elseif($order->status == 'diproses') bg-info
                                      @elseif($order->status == 'selesai') bg-success
                                      @else bg-danger @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </p>
                                <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Bukti Transfer</h5>
                                @if ($order->bukti_transfer)
                                    <a href="{{ Storage::url($order->bukti_transfer) }}" target="_blank">
                                        <img src="{{ Storage::url($order->bukti_transfer) }}" alt="Bukti Transfer"
                                            class="img-fluid img-thumbnail" style="max-width: 300px;">
                                    </a>
                                    <p class="mt-2"><small class="text-muted">Klik gambar untuk melihat ukuran
                                            penuh.</small></p>
                                @else
                                    <p>Tidak ada bukti transfer diunggah.</p>
                                @endif
                            </div>
                        </div>

                        <h5 class="mt-4">Item Pesanan</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Hewan</th>
                                        <th>Jumlah</th>
                                        <th>Harga Satuan</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>{{ $item->hewan->nama }}</td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($item->jumlah * $item->harga_satuan, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali ke Daftar
                                Pesanan</a>
                            @if ($order->status == 'pending')
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST"
                                    class="d-inline ms-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="diproses">
                                    <button type="submit" class="btn btn-primary"
                                        onclick="return confirm('Ubah status menjadi Diproses?')">Proses Pesanan</button>
                                </form>
                            @elseif ($order->status == 'diproses')
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST"
                                    class="d-inline ms-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="selesai">
                                    <button type="submit" class="btn btn-success"
                                        onclick="return confirm('Ubah status menjadi Selesai?')">Selesaikan Pesanan</button>
                                </form>
                            @endif
                            @if ($order->status != 'selesai' && $order->status != 'dibatalkan')
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST"
                                    class="d-inline ms-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="dibatalkan">
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Batalkan pesanan ini?')">Batalkan Pesanan</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
