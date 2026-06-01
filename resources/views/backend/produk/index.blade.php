@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Katalog Produk</h5>
                <a href="{{ route('admin.produk.buat') }}" class="btn btn-primary">Tambah Produk Baru</a>
            </div>
            
            @if(session('success'))
            <div class="alert alert-success mx-4">
                {{ session('success') }}
            </div>
            @endif

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($produk as $item)
                        <tr>
                            <td>
                                @if($item->gambar_mini)
                                    <img src="{{ asset('storage/' . $item->gambar_mini) }}" alt="Produk" class="rounded" width="50">
                                @else
                                    <span class="badge bg-label-secondary">Tidak ada Gambar</span>
                                @endif
                            </td>
                            <td><strong>{{ $item->nama }}</strong></td>
                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>
                                @if($item->stok > 0)
                                    <span class="badge bg-label-success">{{ $item->stok }}</span>
                                @else
                                    <span class="badge bg-label-danger">Stok Habis</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.produk.ubah', $item->id) }}" class="btn btn-sm btn-info"><i class="bx bx-edit-alt me-1"></i> Ubah</a>
                                <form action="{{ route('admin.produk.hapus', $item->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bx bx-trash me-1"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Produk tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $produk->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
