@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Catalog (Products)</h5>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New Product</a>
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($products as $product)
                        <tr>
                            <td>
                                @if($product->thumbnail)
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Product" class="rounded" width="50">
                                @else
                                    <span class="badge bg-label-secondary">No Image</span>
                                @endif
                            </td>
                            <td><strong>{{ $product->name }}</strong></td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>
                                @if($product->stock > 0)
                                    <span class="badge bg-label-success">{{ $product->stock }}</span>
                                @else
                                    <span class="badge bg-label-danger">Out of stock</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-info"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bx bx-trash me-1"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No products found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
