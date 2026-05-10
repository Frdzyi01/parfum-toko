@extends('backend.layouts.app')

@section('content')
<div class="row">
    <!-- Welcome Card -->
    <div class="col-xxl-8 mb-6 order-0">
        <div class="card">
            <div class="d-flex align-items-start row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary mb-3">Welcome to Dashboard! 🎉</h5>
                        <p class="mb-6">
                            Here is an overview of your store's performance.<br />Keep up the good work!
                        </p>
                        <a href="{{ route('admin.transactions.index') }}" class="btn btn-sm btn-outline-primary">View Orders</a>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-6">
                        <img src="{{ asset('template-admin/assets/img/illustrations/man-with-laptop.png') }}" height="175" alt="View Badge User" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="col-xxl-4 col-lg-12 col-md-4 order-1">
        <div class="row">
            <!-- Total Revenue -->
            <div class="col-lg-6 col-md-12 col-6 mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="avatar flex-shrink-0">
                                <span class="avatar-initial rounded bg-label-success"><i class="bx bx-dollar"></i></span>
                            </div>
                        </div>
                        <p class="mb-1">Total Revenue</p>
                        <h4 class="card-title mb-3">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
                        <small class="text-muted">From paid/completed</small>
                    </div>
                </div>
            </div>
            
            <!-- Total Orders -->
            <div class="col-lg-6 col-md-12 col-6 mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="avatar flex-shrink-0">
                                <span class="avatar-initial rounded bg-label-info"><i class="bx bx-cart"></i></span>
                            </div>
                        </div>
                        <p class="mb-1">Total Orders</p>
                        <h4 class="card-title mb-3">{{ $totalOrders }}</h4>
                        <small class="text-muted">All time</small>
                    </div>
                </div>
            </div>
            
            <!-- Total Products -->
            <div class="col-lg-6 col-md-12 col-6 mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="avatar flex-shrink-0">
                                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-box"></i></span>
                            </div>
                        </div>
                        <p class="mb-1">Total Products</p>
                        <h4 class="card-title mb-3">{{ $totalProducts }}</h4>
                        <small class="text-muted">In catalog</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Transactions -->
    <div class="col-12 order-2 mb-6">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">Recent Transactions</h5>
                <a href="{{ route('admin.transactions.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Client Name</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($recentTransactions as $transaction)
                        <tr>
                            <td><a href="{{ route('admin.transactions.show', $transaction->id) }}"><strong>{{ $transaction->invoice_number }}</strong></a></td>
                            <td>{{ $transaction->user->name ?? 'Guest' }}</td>
                            <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $statusClass = [
                                        'pending' => 'bg-label-warning',
                                        'processing' => 'bg-label-info',
                                        'completed' => 'bg-label-success',
                                        'cancelled' => 'bg-label-danger'
                                    ];
                                @endphp
                                <span class="badge {{ $statusClass[$transaction->status] ?? 'bg-label-secondary' }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No recent transactions.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
