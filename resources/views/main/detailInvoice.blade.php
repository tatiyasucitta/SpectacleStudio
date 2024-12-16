@extends('layouts.master')

@section('content')
    @if(Session::has('success'))
        <p class="alert alert-success" style="margin:2rem;">{{Session::get('success')}}</p>
    @endif
    <br>
    <h4>Invoice Detail for Invoice #{{$invoice}}</h4>
    <br>
    
    <div class="invoice-table">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
            @for($i = 0 ; $i < count($items) ; $i++)
                <tr>
                    <th scope="row">{{$i+1}}</th>
                    <td>
                        <h5 class="card-title">{{$items[$i]->product[0]->name}}</h5>
                    </td>
                    <td>
                        <img src="{{asset('/storage/public/images/products/'.$items[$i]->product[0]->image)}}" class="card-img-top w-25" alt="">
                    </td>
                    <td>
                        <p class="card-price">${{$items[$i]->product[0]->price}}</p>
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
    </div>
    
    <div class="total">
        <ul class="list-group">
            <li class="list-group-item list-group-item-success">
                <h4>Total:</h4>
                <h4 class="total">${{$total}}.00</h4>
            </li>
        </ul>
    </div>
@endsection
