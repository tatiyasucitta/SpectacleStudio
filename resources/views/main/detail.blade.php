@extends('layouts.master')

@section('content')
    <div class="product-details p-4">
        <h1 class="mb-3">{{ $product->name }}</h1>
        <div class="d-flex">
            <img src="{{ asset('/storage/public/images/products/'.$product->image) }}" alt="{{ $product->name }}" class="img-fluid mb-3 me-4" style="max-width: 500px; height: auto;">
            <div>
                <p class="mb-2">{{ $product->description }}</p>
                <p class="mb-2">${{ $product->price }}</p>
                <p class="mb-4">{{ $product->stock }} pc(s) left</p>
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex flex-column gap-2">
                    @csrf
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control">
                    <button type="submit" class="btn" style="background-color: #736960; color: white; margin-top: 10px;">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
@endsection
