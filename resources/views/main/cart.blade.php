@extends('layouts.master')

@section('content')
    <h2 style="padding: 20px 0; text-align: center; color: #736960;">Your Cart</h2>
    @if(!$items)
    <h4 style="padding: 10px 0; text-align: center; color: #000000;">Your Cart is Empty</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td class="text-center">
                            <img src="{{ asset('/storage/public/images/products/'.$item->product[0]->image) }}" alt="{{ $item->product[0]->name }}" class="img-fluid" style="max-width: 200px; height: auto; display: block; margin: 0 auto;">
                        </td>
                        <td>{{ $item->product[0]->name }}</td>
                        <td>${{ $item->product[0]->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ $item->quantity * $item->product[0]->price }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3 style="padding: 10px; background-color: #f2f2f2;">Total Price: ${{ $total }}</h3>
        <a href="{{ route('checkout') }}" class="d-block">
            <button class="btn btn-block btn-primary" style="background-color: #736960; color: white; padding: 10px;">Check Out</button>
        </a>    
    @endif
@endsection
