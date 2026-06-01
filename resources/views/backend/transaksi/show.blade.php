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
                                <option value="pending" {{ $transaksi->status == 'pending' ? 'selected' : '' }}>Tertunda</option>
                                <option value="processing" {{ $transaksi->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                                <option value="completed" {{ $transaksi->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="cancelled" {{ $transaksi->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">Perbarui</button>
                        </form>
                    </div>
                </div>

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
