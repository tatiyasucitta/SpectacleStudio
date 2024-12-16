@extends('layouts.master')

@section('content')
<h1 class="text-center">Category: {{ ucfirst($category) }}</h1>
<div class="row">
    @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Price: ${{ $product->price }}</p>
                    <a href="/product/{{ $product->id }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
