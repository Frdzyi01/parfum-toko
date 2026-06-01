@extends('backend.layouts.app')

@section('content')
<style>
    /* Screen layout styling for Laporan Penjualan */
    .filter-card {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
    }
    
    .filter-form-group {
        display: flex;
        align-items: flex-end;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .filter-input-wrapper {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    
    .filter-label {
        font-family: 'Inter', sans-serif;
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
    }
    
    .filter-control {
        padding: 10px 16px;
        border-radius: 8px;
        border: 1.5px solid #cbd5e1;
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        color: #1e293b;
        outline: none;
        transition: all 0.2s ease;
        background-color: #f8fafc;
    }
    
    .filter-control:focus {
        border-color: #632c9b;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(99, 44, 155, 0.15);
    }
    
    .btn-purple {
        background-color: #632c9b !important;
        color: #ffffff !important;
        padding: 11px 24px;
        border-radius: 8px;
        font-family: 'Inter', sans-serif;
        font-size: 0.88rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(99, 44, 155, 0.15);
    }
    
    .btn-purple:hover {
        background-color: #522283 !important;
        box-shadow: 0 6px 16px rgba(99, 44, 155, 0.25);
    }
    
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stats-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 20px 24px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        transition: transform 0.2s;
    }
    
    .stats-card:hover {
        transform: translateY(-2px);
    }
    
    .stats-title {
        font-family: 'Inter', sans-serif;
        font-size: 0.85rem;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 8px;
    }
    
    .stats-value {
        font-family: 'Inter', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #0f172a;
    }
    
    /* Custom Tabs */
    .nav-tabs-custom {
        display: flex;
        border-bottom: 2px solid #e2e8f0;
        margin-bottom: 25px;
        gap: 20px;
        list-style: none;
        padding: 0;
    }
    
    .nav-tabs-custom li {
        margin: 0;
    }
    
    .nav-tabs-custom a {
        display: block;
        padding: 12px 10px;
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        font-weight: 600;
        color: #64748b;
        text-decoration: none;
        border-bottom: 2px solid transparent;
        margin-bottom: -2px;
        transition: all 0.2s;
    }
    
    .nav-tabs-custom li.active a {
        color: #632c9b;
        border-color: #632c9b;
    }

    /* Print Styles */
    @media print {
        #layout-menu, 
        .layout-navbar,
        .content-footer,
        .filter-card,
        .nav-tabs-custom,
        .btn,
        .btn-purple {
            display: none !important;
        }
        
        .content-wrapper, 
        .container-xxl,
        .card {
            margin: 0 !important;
            padding: 0 !important;
            border: none !important;
            box-shadow: none !important;
            background: transparent !important;
        }
        
        .card-body {
            padding: 0 !important;
        }
        
        .table-responsive {
            overflow: visible !important;
        }
        
        .stats-container {
            display: flex !important;
            flex-direction: row !important;
            gap: 15px !important;
            margin-bottom: 30px !important;
            width: 100% !important;
        }
        
        .stats-card {
            flex: 1 !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 8px !important;
            padding: 15px !important;
            background: #ffffff !important;
            box-shadow: none !important;
        }
    }
    
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        .filter-form-group {
            flex-direction: column;
            align-items: stretch;
        }
        .filter-control {
            width: 100%;
        }
    }
</style>

<div class="container-fluid p-0">
    <!-- Tab Navigation -->
    <ul class="nav-tabs-custom d-print-none">
        <li class="{{ $tab == 'laporan' ? 'active' : '' }}">
            <a href="{{ route('admin.transaksi.index') }}">
                <i class="bx bx-bar-chart-alt-2 me-1"></i> Laporan Penjualan
            </a>
        </li>
        <li class="{{ $tab == 'semua_pesanan' ? 'active' : '' }}">
            <a href="{{ route('admin.transaksi.index') }}?tab=semua_pesanan">
                <i class="bx bx-receipt me-1"></i> Daftar Transaksi (Pesanan)
            </a>
        </li>
    </ul>

    @if($tab == 'laporan')
        <!-- LAPORAN PENJUALAN VIEW -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0" style="font-family:'Inter', sans-serif; font-weight: 700; color: #0f172a;">Laporan Penjualan</h4>
        </div>

        <!-- Filter Card -->
        <div class="card filter-card mb-4 d-print-none">
            <div class="card-body">
                <form action="{{ route('admin.transaksi.index') }}" method="GET">
                    <div class="d-flex justify-content-between align-items-end flex-wrap gap-3">
                        <div class="filter-form-group">
                            <div class="filter-input-wrapper">
                                <span class="filter-label">Dari Tanggal</span>
                                <input type="date" name="tanggal_mulai" class="filter-control" value="{{ $tanggalMulai->format('Y-m-d') }}">
                            </div>
                            <div class="filter-input-wrapper">
                                <span class="filter-label">Sampai Tanggal</span>
                                <input type="date" name="tanggal_selesai" class="filter-control" value="{{ $tanggalSelesai->format('Y-m-d') }}">
                            </div>
                            <button type="submit" class="btn-purple">Tampilkan</button>
                        </div>
                        <div>
                            <button type="button" onclick="window.print()" class="btn-purple">
                                <i class="bx bx-printer me-1"></i> Ekspor PDF
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid stats-container">
            <div class="stats-card">
                <div class="stats-title">Total Transaksi</div>
                <div class="stats-value">{{ $totalTransaksi }}</div>
            </div>
            <div class="stats-card">
                <div class="stats-title">Total Pendapatan</div>
                <div class="stats-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            </div>
            <div class="stats-card">
                <div class="stats-title">Rata-rata Transaksi</div>
                <div class="stats-value">Rp {{ number_format($rataRataTransaksi, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card" style="border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02); overflow: hidden;">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover" style="margin-bottom: 0;">
                    <thead>
                        <tr style="background-color: #f8fafc; border-bottom: 1.5px solid #e2e8f0;">
                            <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">No</th>
                            <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">Tanggal</th>
                            <th style="font-weight: 600; color: #475569; padding: 16px 24px; text-align: center; border: none;">Total Transaksi</th>
                            <th style="font-weight: 600; color: #475569; padding: 16px 24px; text-align: right; border: none;">Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataLaporan as $index => $row)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 16px 24px; font-weight: 500; border: none;">{{ $index + 1 }}</td>
                            <td style="padding: 16px 24px; font-weight: 500; border: none;">{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}</td>
                            <td style="padding: 16px 24px; font-weight: 500; text-align: center; border: none;">{{ $row->jumlah }}</td>
                            <td style="padding: 16px 24px; font-weight: 600; text-align: right; color: #632c9b; border: none;">Rp {{ number_format($row->pendapatan, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center" style="padding: 30px; color: #64748b; border: none;">Belum ada data transaksi untuk periode ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    @else
        <!-- ALL ORDERS VIEW (Original Transactions Listing) -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0" style="font-family:'Inter', sans-serif; font-weight: 700; color: #0f172a;">Daftar Transaksi</h4>
        </div>

        <div class="card" style="border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02); overflow: hidden;">
            @if(session('success'))
            <div class="alert alert-success mx-4 mt-4">
                {{ session('success') }}
            </div>
            @endif

            <div class="table-responsive text-nowrap">
                <table class="table table-hover" style="margin-bottom: 0;">
                    <thead>
                        <tr style="background-color: #f8fafc; border-bottom: 1.5px solid #e2e8f0;">
                            <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">Invoice</th>
                            <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">Pelanggan</th>
                            <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">Total Belanja</th>
                            <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">Status</th>
                            <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">Tanggal</th>
                            <th style="font-weight: 600; color: #475569; padding: 16px 24px; text-align: center; border: none;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $t)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 16px 24px; border: none;"><strong>{{ $t->nomor_invoice }}</strong></td>
                            <td style="padding: 16px 24px; border: none;">{{ $t->pengguna->nama ?? 'Guest' }}</td>
                            <td style="padding: 16px 24px; font-weight: 600; color: #632c9b; border: none;">Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                            <td style="padding: 16px 24px; border: none;">
                                @php
                                    $statusClass = [
                                        'pending' => 'bg-label-warning',
                                        'processing' => 'bg-label-info',
                                        'completed' => 'bg-label-success',
                                        'cancelled' => 'bg-label-danger'
                                    ];
                                    $statusLabel = [
                                        'pending' => 'Tertunda',
                                        'processing' => 'Diproses',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan'
                                    ];
                                @endphp
                                <span class="badge {{ $statusClass[$t->status] ?? 'bg-label-secondary' }}">
                                    {{ $statusLabel[$t->status] ?? ucfirst($t->status) }}
                                </span>
                            </td>
                            <td style="padding: 16px 24px; border: none;">{{ $t->created_at->format('d M Y H:i') }}</td>
                            <td style="padding: 16px 24px; text-align: center; border: none;">
                                <a href="{{ route('admin.transaksi.tampilkan', $t->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                                    <i class="bx bx-show-alt me-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center" style="padding: 30px; color: #64748b; border: none;">Belum ada pesanan masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer" style="background-color: transparent; border-top: 1px solid #f1f5f9;">
                {{ $transaksi->appends(['tab' => 'semua_pesanan'])->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
