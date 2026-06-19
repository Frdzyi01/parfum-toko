@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detail Pesanan: {{ $transaksi->nomor_invoice }}</h5>
                <a href="{{ route('admin.transaksi.index') }}?tab=semua_pesanan" class="btn btn-sm btn-secondary">Kembali ke Pesanan</a>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-2">Detail Pelanggan:</h6>
                        <p class="mb-1"><strong>Nama:</strong> {{ $transaksi->pengguna->nama ?? 'Guest' }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $transaksi->pengguna->email ?? 'N/A' }}</p>
                        <p class="mb-0"><strong>Tanggal Pesanan:</strong> {{ $transaksi->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div class="col-sm-6 text-sm-end">
                        <h6 class="mb-2">Perbarui Status:</h6>
                        <form action="{{ route('admin.transaksi.perbarui', $transaksi->id) }}" method="POST" class="d-inline-flex align-items-center">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select form-select-sm me-2" style="width: auto;">
                                <option value="menunggu_pembayaran" {{ $transaksi->status == 'menunggu_pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                                <option value="dibayar" {{ $transaksi->status == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                                <option value="processing" {{ $transaksi->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                                <option value="completed" {{ $transaksi->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="cancelled" {{ $transaksi->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">Perbarui</button>
                        </form>
                    </div>
                </div>

                <!-- Informasi Pembayaran -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                <h6 class="mb-3"><i class="bx bx-credit-card"></i> Informasi Pembayaran</h6>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <small class="text-muted">Status</small>
                                        <div>
                                            <span class="badge" style="background:{{ $transaksi->warna_status }}; color:#fff;">
                                                {{ $transaksi->label_status }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <small class="text-muted">Metode Pembayaran</small>
                                        <div><strong>{{ $transaksi->metode_pembayaran ?? '-' }}</strong></div>
                                    </div>
                                    <div class="col-sm-4">
                                        <small class="text-muted">Waktu Pembayaran</small>
                                        <div><strong>{{ $transaksi->dibayar_pada ? $transaksi->dibayar_pada->format('d M Y H:i') : '-' }}</strong></div>
                                    </div>
                                </div>

                                @if($transaksi->bukti_pembayaran)
                                <div class="mt-3">
                                    <small class="text-muted">Bukti Pembayaran:</small>
                                    <div class="mt-2">
                                        <a href="{{ $transaksi->bukti_pembayaran_url }}" target="_blank">
                                            <img src="{{ $transaksi->bukti_pembayaran_url }}" 
                                                 alt="Bukti Pembayaran" 
                                                 style="max-width:250px; border-radius:8px; border:1px solid #dee2e6; cursor:pointer;">
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if($transaksi->catatan)
                <div class="alert alert-light border mb-4">
                    <small class="text-muted">Catatan Pelanggan:</small>
                    <p class="mb-0 mt-1">{{ $transaksi->catatan }}</p>
                </div>
                @endif

                <div class="table-responsive text-nowrap border rounded">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi->item as $item)
                            <tr>
                                <td>{{ $item->produk->nama ?? 'Produk Dihapus' }}</td>
                                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="3" class="text-end">Total Belanja:</th>
                                <th>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
