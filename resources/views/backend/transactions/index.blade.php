@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Client Orders (Transactions)</h5>
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
                            <th>Invoice</th>
                            <th>Client Name</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($transactions as $transaction)
                        <tr>
                            <td><strong>{{ $transaction->invoice }}</strong></td>
                            <td>{{ $transaction->user->name ?? 'Guest' }}</td>
                            <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $statusClass = [
                                        'pending' => 'bg-label-warning',
                                        'paid' => 'bg-label-info',
                                        'shipped' => 'bg-label-primary',
                                        'completed' => 'bg-label-success',
                                        'cancelled' => 'bg-label-danger'
                                    ];
                                @endphp
                                <span class="badge {{ $statusClass[$transaction->status] ?? 'bg-label-secondary' }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.transactions.show', $transaction->id) }}" class="btn btn-sm btn-info">
                                    <i class="bx bx-show-alt me-1"></i> View Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No orders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
