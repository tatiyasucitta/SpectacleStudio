@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <label for="checkout-page" class="checkout-header">Checkout</label>
    <div class="mb-3">
    </div>    <br>
    
    <!-- Product Summary -->
    <table class="table">
        <thead>
            <tr>
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
                <td>{{ $item->product[0]->name }}</td>
                <td>${{ $item->product[0]->price }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ $item->quantity * $item->product[0] ->price }}</td>
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
        
    <!-- Total Price -->
    <h3 class="mb-4">Total Price: ${{ $total }}</h3>
    
    <!-- Address and Payment Form -->
    <h4>Checkout</h4>
    <form action="{{route('save', $user->id)}}" method="POST" id="address-form" class="mb-5">
        @csrf
        <label for="invoice" class="form-label">Invoice Number:</label>
        <input type="text" class="form-control" id="invoice" name="invoice" value="{{$invoice}}" placeholder="{{$invoice}}" aria-label="Disabled input example" readonly>
        <!-- Shipping Address -->
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Full Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="billing-address" class="form-label">Billing Address (if different from shipping address)</label>
            <input type="text" class="form-control" id="billing-address" name="billing_address">
        </div>
        

        <button type="submit" class="btn" style="background-color: #736960; color: white; padding: 10px 20px;">Checkout</button>
    </form>

    @if ($errors->any())
        <li class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </li>
    @endif
    @if(session()->has('success'))
        <p class="alert alert-success"> {{ session()->get('success') }}</p>
    @endif
</div>
@endsection
