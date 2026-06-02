@extends('backend.layouts.app')

@section('content')
<style>
    /* Stats Card Styles */
    .stats-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 20px 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 350px;
        margin-bottom: 25px;
        transition: all 0.25s ease;
    }
    .stats-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.04);
        border-color: rgba(99, 44, 155, 0.2);
    }
    .stats-title {
        font-family: 'Inter', sans-serif;
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 6px;
    }
    .stats-value {
        font-family: 'Inter', sans-serif;
        font-size: 1.45rem;
        font-weight: 700;
        color: #0f172a;
    }
    .stats-icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        background-color: rgba(99, 44, 155, 0.1);
        color: #632c9b;
    }
</style>

<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0" style="font-family:'Inter', sans-serif; font-weight: 700; color: #0f172a;">Manajemen Pelanggan</h4>
    </div>

    <!-- Stats Card -->
    <div class="stats-card">
        <div>
            <div class="stats-title">Total Pelanggan</div>
            <div class="stats-value">{{ $totalPelanggan }}</div>
        </div>
        <div class="stats-icon-wrapper">
            <i class="bx bx-user"></i>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card" style="border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02); overflow: hidden;">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover" style="margin-bottom: 0;">
                <thead>
                    <tr style="background-color: #f8fafc; border-bottom: 1.5px solid #e2e8f0;">
                        <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">No</th>
                        <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">Nama Pelanggan</th>
                        <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">Email</th>
                        <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">Bergabung Pada</th>
                        <th style="font-weight: 600; color: #475569; padding: 16px 24px; text-align: center; border: none;">Jumlah Transaksi</th>
                        <th style="font-weight: 600; color: #475569; padding: 16px 24px; text-align: right; border: none;">Total Belanja</th>
                        <th style="font-weight: 600; color: #475569; padding: 16px 24px; text-align: center; border: none;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggan as $index => $p)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 16px 24px; border: none; font-weight: 500;">
                            {{ $pelanggan->firstItem() + $index }}
                        </td>
                        <td style="padding: 16px 24px; border: none; font-weight: 600; color: #1e293b;">
                            {{ $p->nama }}
                        </td>
                        <td style="padding: 16px 24px; border: none;">
                            {{ $p->email }}
                        </td>
                        <td style="padding: 16px 24px; border: none;">
                            {{ $p->created_at ? $p->created_at->format('d M Y') : 'N/A' }}
                        </td>
                        <td style="padding: 16px 24px; border: none; text-align: center; font-weight: 500;">
                            {{ $p->transaksi_count }}
                        </td>
                        <td style="padding: 16px 24px; border: none; text-align: right; font-weight: 600; color: #632c9b;">
                            Rp {{ number_format($p->total_belanja ?? 0, 0, ',', '.') }}
                        </td>
                        <td style="padding: 16px 24px; text-align: center; border: none;">
                            <a href="{{ route('admin.pelanggan.tampilkan', $p->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px; font-weight: 600;">
                                <i class="bx bx-show-alt me-1"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center" style="padding: 30px; color: #64748b; border: none;">Belum ada data pelanggan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer" style="background-color: transparent; border-top: 1px solid #f1f5f9; padding: 20px 24px;">
            {{ $pelanggan->links() }}
        </div>
    </div>
</div>
@endsection
