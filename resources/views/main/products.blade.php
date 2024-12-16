@extends('layouts.master')

@section('content')

<h2 style="padding: 20px 0; text-align: center; color: #736960;">Our Products</h2>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 w-25">
                <div class="card mb-4 w-100">
                    <div class="card-body w-auto d-flex flex-column g-0" style="padding: 15px;">
                        <h4 class="card-title">{{ $product->name }}</h4>
                        <img src="{{ asset('/storage/public/images/products/'.$product->image) }}" alt="{{ $product->name }}" style="border: 0px solid rgb(0, 0, 0);">
                        <h5>{{ $product->category->name }}</h5>
                        <p>{{ $product->description }}</p>
                        <p>${{ $product->price }}</p>
                        <p>{{ $product->stock }} pc(s) left</p>
                        @if(auth()->check() && auth()->user()->isAdmin === 1)
                            <div class="action-div d-flex flex-row gap-2">
                                <a href="{{ route('update', $product->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('delete', $product->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('product.detail', $product->id) }}" class="btn" style="background-color: #736960; color: white;">View Details</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
