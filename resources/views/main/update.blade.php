@extends('layouts.master')

@section('content')
    <form action="{{route('updated', $item->id)}}" method="POST" style="margin:20px" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <label for="" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="" value="{{$item->name}}">
        
        <label for="" class="form-label">Category</label>
        <select name="category_id"class="form-select" aria-label="Default select example">
            <option selected value="{{$item->category_id}}" >{{$item->category->name}}</option>
            @foreach($cat as $cats)
                <option value="{{$cats->id}}">{{$cats->name}}</option>
            @endforeach
        </select>

        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input class="form-control" type="file" id="formFile" name="image">
        </div>
        <label for="" class="form-label">Price</label>
        <input type="number" name="price" class="form-control" id="" value="{{$item->price}}">

        <label for="" class="form-label">Stock</label>
        <input type="number" name="stock" class="form-control" id="" value="{{$item->stock}}">

        @if ($errors->any())
            <li class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </li>
        @endif
        @if(session()->has('success'))
            <p class="alert alert-success"> {{ session()->get('success') }}</p>
        @endif
        <button value="submit" type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>
    </form>
@endsection
