@extends('backend.layouts.app')

@section('content')
<style>
    /* Customer Profile and Detail Card Styles */
    .customer-profile-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        margin-bottom: 25px;
    }
    .profile-label {
        font-family: 'Inter', sans-serif;
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    .profile-value {
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 16px;
    }
    .stats-card-mini {
        background: #ffffff;
        border-radius: 10px;
        padding: 16px 20px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.01);
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .stats-card-mini-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
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
</style>

<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0" style="font-family:'Inter', sans-serif; font-weight: 700; color: #0f172a;">Detail Pelanggan</h4>
        <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-sm btn-secondary" style="border-radius: 8px;">
            <i class="bx bx-chevron-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row">
        <!-- Profile Column -->
        <div class="col-md-4">
            <div class="customer-profile-card">
                <h5 class="mb-4" style="font-family:'Inter', sans-serif; font-weight: 700; color: #0f172a; border-bottom: 1.5px solid #f1f5f9; padding-bottom: 12px;">Profil Pelanggan</h5>
                
                <div class="profile-label">Nama Lengkap</div>
                <div class="profile-value">{{ $pelanggan->nama }}</div>

                <div class="profile-label">Alamat Email</div>
                <div class="profile-value">{{ $pelanggan->email }}</div>

                <div class="profile-label">Tanggal Bergabung</div>
                <div class="profile-value">{{ $pelanggan->created_at ? $pelanggan->created_at->format('d F Y (H:i)') : 'N/A' }}</div>
            </div>
            
            <!-- Mini stats -->
            <div class="row g-3 mb-4">
                <div class="col-6">
                    <div class="stats-card-mini">
                        <div class="stats-card-mini-icon" style="background-color: rgba(99, 44, 155, 0.1); color: #632c9b;">
                            <i class="bx bx-cart"></i>
                        </div>
                        <div>
                            <div style="font-size: 0.75rem; color: #64748b; font-weight: 600;">Transaksi</div>
                            <div style="font-size: 1.1rem; font-weight: 700; color: #1e293b;">{{ $totalTransaksi }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stats-card-mini">
                        <div class="stats-card-mini-icon" style="background-color: rgba(34, 197, 94, 0.1); color: #22c55e;">
                            <i class="bx bx-wallet"></i>
                        </div>
                        <div>
                            <div style="font-size: 0.75rem; color: #64748b; font-weight: 600;">Total Belanja</div>
                            <div style="font-size: 0.95rem; font-weight: 700; color: #1e293b; white-space: nowrap;">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- History Column -->
        <div class="col-md-8">
            <div class="card" style="border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02); overflow: hidden;">
                <div class="card-header" style="background-color: #ffffff; border-bottom: 1.5px solid #e2e8f0; padding: 20px 24px;">
                    <h5 class="card-title m-0" style="font-family:'Inter', sans-serif; font-weight: 700; color: #0f172a; font-size: 1rem;">Riwayat Transaksi</h5>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" style="margin-bottom: 0;">
                        <thead>
                            <tr style="background-color: #f8fafc; border-bottom: 1.5px solid #e2e8f0;">
                                <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">No</th>
                                <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">Tanggal</th>
                                <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">No. Invoice</th>
                                <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">Total Belanja</th>
                                <th style="font-weight: 600; color: #475569; padding: 16px 24px; border: none;">Status</th>
                                <th style="font-weight: 600; color: #475569; padding: 16px 24px; text-align: center; border: none;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pelanggan->transaksi as $index => $t)
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 16px 24px; border: none; font-weight: 500;">{{ $index + 1 }}</td>
                                <td style="padding: 16px 24px; border: none;">{{ $t->created_at->format('d/m/Y') }}</td>
                                <td style="padding: 16px 24px; border: none; font-weight: 600;">{{ $t->nomor_invoice }}</td>
                                <td style="padding: 16px 24px; border: none; font-weight: 600; color: #632c9b;">{{ $t->total_format }}</td>
                                <td style="padding: 16px 24px; border: none;">
                                    @php
                                        $statusMap = [
                                            'pending' => ['label' => 'Tertunda', 'class' => 'status-badge-pending'],
                                            'processing' => ['label' => 'Diproses', 'class' => 'status-badge-processing'],
                                            'completed' => ['label' => 'Selesai', 'class' => 'status-badge-completed'],
                                            'cancelled' => ['label' => 'Dibatalkan', 'class' => 'status-badge-cancelled']
                                        ];
                                        $statusDetail = $statusMap[$t->status] ?? ['label' => ucfirst($t->status), 'class' => 'bg-secondary text-white'];
                                    @endphp
                                    <span class="status-badge-custom {{ $statusDetail['class'] }}">
                                        {{ $statusDetail['label'] }}
                                    </span>
                                </td>
                                <td style="padding: 16px 24px; text-align: center; border: none;">
                                    <a href="{{ route('admin.transaksi.tampilkan', $t->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px; font-weight: 600;">
                                        <i class="bx bx-show-alt me-1"></i> Detail Order
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center" style="padding: 30px; color: #64748b; border: none;">Belum ada riwayat transaksi untuk pelanggan ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
