@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <label for="checkout-page" class="checkout-header">Checkout</label>
    <h5>Invoice Number: {{$invoice}}</h5>
    <br>
    
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
    <form action="{{route('save')}}" method="POST" id="address-form" class="mb-5">
        @csrf
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
        
        <!-- Payment Details -->
        <h4>Payment Details</h4>
        <div class="mb-3">
            <label for="payment-method" class="form-label">Payment Method</label>
            <select class="form-control" id="payment-method" name="payment_method" required>
                <option value="credit_card">Credit Card</option>
                <option value="bank_transfer">Debit Card</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="card-number" class="form-label">Card Number</label>
            <input type="text" class="form-control" id="card-number" name="card_number" placeholder="1234 5678 9101 1121">
        </div>
        <div class="mb-3">
            <label for="expiration-date" class="form-label">Expiration Date</label>
            <input type="text" class="form-control" id="expiration-date" name="expiration_date" placeholder="MM/YY">
        </div>
        <div class="mb-3">
            <label for="cvv" class="form-label">CVV</label>
            <input type="text" class="form-control" id="cvv" name="cvv">
        </div>

        <!-- Order Notes -->
        <h4>Order Notes</h4>
        <div class="mb-3">
            <label for="order-notes" class="form-label">Special Instructions or Notes</label>
            <textarea class="form-control" id="order-notes" name="order_notes"></textarea>
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
