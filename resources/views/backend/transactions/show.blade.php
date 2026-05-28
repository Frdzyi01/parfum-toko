@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Order Detail: {{ $transaction->invoice_number }}</h5>
                <a href="{{ route('admin.transactions.index') }}?tab=all_orders" class="btn btn-sm btn-secondary">Back to Orders</a>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-2">Client Details:</h6>
                        <p class="mb-1"><strong>Name:</strong> {{ $transaction->user->name ?? 'Guest' }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $transaction->user->email ?? 'N/A' }}</p>
                        <p class="mb-0"><strong>Order Date:</strong> {{ $transaction->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div class="col-sm-6 text-sm-end">
                        <h6 class="mb-2">Update Status:</h6>
                        <form action="{{ route('admin.transactions.update', $transaction->id) }}" method="POST" class="d-inline-flex align-items-center">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select form-select-sm me-2" style="width: auto;">
                                <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $transaction->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $transaction->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $transaction->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </form>
                    </div>
                </div>

                <div class="table-responsive text-nowrap border rounded">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaction->items as $item)
                            <tr>
                                <td>{{ $item->product->name ?? 'Deleted Product' }}</td>
                                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="3" class="text-end">Total Amount:</th>
                                <th>Rp {{ number_format($transaction->total, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
