@extends('backend.layouts.app')

@section('content')
<style>
    /* Dashboard Stats & Card Styles */
    .dashboard-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .dashboard-stats-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 20px 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.25s ease;
    }
    
    .dashboard-stats-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.04);
        border-color: rgba(99, 44, 155, 0.2);
    }
    
    .stats-card-info {
        display: flex;
        flex-direction: column;
    }
    
    .stats-card-label {
        font-family: 'Inter', sans-serif;
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 6px;
    }
    
    .stats-card-value {
        font-family: 'Inter', sans-serif;
        font-size: 1.45rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 4px;
        line-height: 1.25;
    }
    
    .stats-card-subtext {
        font-family: 'Inter', sans-serif;
        font-size: 0.75rem;
        color: #94a3b8;
    }
    
    .stats-card-icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
    }
    
    /* Icon wrapper theme colors */
    .icon-wrapper-purple {
        background-color: rgba(99, 44, 155, 0.1);
        color: #632c9b;
    }
    
    .icon-wrapper-green {
        background-color: rgba(34, 197, 94, 0.1);
        color: #22c55e;
    }
    
    .icon-wrapper-teal {
        background-color: rgba(20, 184, 166, 0.1);
        color: #14b8a6;
    }
    
    /* Table modifications */
    .dashboard-table-card {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        overflow: hidden;
    }
    
    .btn-purple-sm {
        background-color: #632c9b !important;
        color: #ffffff !important;
        padding: 8px 16px;
        border-radius: 8px;
        font-family: 'Inter', sans-serif;
        font-size: 0.8rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        text-decoration: none !important;
        transition: all 0.2s ease;
        box-shadow: 0 2px 6px rgba(99, 44, 155, 0.1);
    }
    
    .btn-purple-sm:hover {
        background-color: #522283 !important;
        box-shadow: 0 4px 12px rgba(99, 44, 155, 0.2);
    }
    
    /* Translation of badges to match mockup */
    .status-badge-custom {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 6px;
        font-family: 'Inter', sans-serif;
        font-size: 0.72rem;
        font-weight: 700;
        text-align: center;
    }
    
    .status-badge-completed {
        background-color: rgba(34, 197, 94, 0.15) !important;
        color: #16a34a !important;
    }
    
    .status-badge-pending {
        background-color: rgba(234, 179, 8, 0.15) !important;
        color: #ca8a04 !important;
    }
    
    .status-badge-processing {
        background-color: rgba(59, 130, 246, 0.15) !important;
        color: #2563eb !important;
    }
    
    .status-badge-cancelled {
        background-color: rgba(239, 68, 68, 0.15) !important;
        color: #dc2626 !important;
    }
    
    @media (max-width: 991px) {
        .dashboard-stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 575px) {
        .dashboard-stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0" style="font-family:'Inter', sans-serif; font-weight: 700; color: #0f172a;">Dashboard</h4>
    </div>

    <!-- Stats Cards Grid -->
    <div class="dashboard-stats-grid">
        <!-- Card 1: Total Produk -->
        <div class="dashboard-stats-card">
            <div class="stats-card-info">
                <span class="stats-card-label">Total Produk</span>
                <span class="stats-card-value">{{ $totalProduk }}</span>
                <span class="stats-card-subtext">Produk tersedia</span>
            </div>
            <div class="stats-card-icon-wrapper icon-wrapper-purple">
                <i class="bx bx-box"></i>
            </div>
        </div>

        <!-- Card 2: Total Transaksi -->
        <div class="dashboard-stats-card">
            <div class="stats-card-info">
                <span class="stats-card-label">Total Transaksi</span>
                <span class="stats-card-value">{{ $totalPesanan }}</span>
                <span class="stats-card-subtext">Transaksi selesai</span>
            </div>
            <div class="stats-card-icon-wrapper icon-wrapper-green">
                <i class="bx bx-cart"></i>
            </div>
        </div>

        <!-- Card 3: Total Pendapatan -->
        <div class="dashboard-stats-card">
            <div class="stats-card-info">
                <span class="stats-card-label">Total Pendapatan</span>
                <span class="stats-card-value" style="font-size: 1.25rem;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
                <span class="stats-card-subtext">Bulan ini</span>
            </div>
            <div class="stats-card-icon-wrapper icon-wrapper-teal">
                <i class="bx bx-wallet"></i>
            </div>
        </div>

        <!-- Card 4: Pelanggan -->
        <div class="dashboard-stats-card">
            <div class="stats-card-info">
                <span class="stats-card-label">Pelanggan</span>
                <span class="stats-card-value">{{ $totalPelanggan }}</span>
                <span class="stats-card-subtext">Total pelanggan</span>
            </div>
            <div class="stats-card-icon-wrapper icon-wrapper-purple">
                <i class="bx bx-user"></i>
            </div>
        </div>
    </div>

    <!-- Recent Transactions Table Card -->
    <div class="card dashboard-table-card">
        <div class="card-header d-flex align-items-center justify-content-between" style="background-color: #ffffff; border-bottom: 1.5px solid #e2e8f0; padding: 20px 24px;">
            <h5 class="card-title m-0" style="font-family:'Inter', sans-serif; font-weight: 700; color: #0f172a; font-size: 1rem;">Transaksi Terbaru</h5>
            <a href="{{ route('admin.transaksi.index') }}?tab=all_orders" class="btn-purple-sm">Lihat Semua</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover" style="margin-bottom: 0;">
                <thead>
                    <tr style="background-color: #f8fafc; border-bottom: 1.5px solid #e2e8f0;">
                        <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">No</th>
                        <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">Tanggal</th>
                        <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">No. Invoice</th>
                        <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">Pelanggan</th>
                        <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">Total</th>
                        <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksiTerbaru as $index => $transaksi)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 16px 24px; border: none; font-weight: 500;">{{ $index + 1 }}</td>
                        <td style="padding: 16px 24px; border: none;">{{ $transaksi->created_at->format('d/m/Y') }}</td>
                        <td style="padding: 16px 24px; border: none;">
                            <a href="{{ route('admin.transaksi.tampilkan', $transaksi->id) }}" style="font-weight: 600; color: #632c9b; text-decoration: none;">
                                {{ $transaksi->nomor_invoice }}
                            </a>
                        </td>
                        <td style="padding: 16px 24px; border: none;">{{ $transaksi->pengguna->nama ?? 'Guest' }}</td>
                        <td style="padding: 16px 24px; border: none; font-weight: 600; color: #632c9b;">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                        <td style="padding: 16px 24px; border: none;">
                            @php
                                $statusMap = [
                                    'pending' => ['label' => 'Tertunda', 'class' => 'status-badge-pending'],
                                    'processing' => ['label' => 'Diproses', 'class' => 'status-badge-processing'],
                                    'completed' => ['label' => 'Selesai', 'class' => 'status-badge-completed'],
                                    'cancelled' => ['label' => 'Dibatalkan', 'class' => 'status-badge-cancelled']
                                ];
                                $statusDetail = $statusMap[$transaksi->status] ?? ['label' => ucfirst($transaksi->status), 'class' => 'bg-secondary text-white'];
                            @endphp
                            <span class="status-badge-custom {{ $statusDetail['class'] }}">
                                {{ $statusDetail['label'] }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center" style="padding: 30px; color: #64748b; border: none;">Belum ada transaksi terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
