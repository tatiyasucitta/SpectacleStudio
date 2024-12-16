@extends('layouts.master')

@section('content')
    <form action="{{route('createditem')}}" method="POST" style="margin:20px" enctype="multipart/form-data">
        @csrf
        <label for="" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="">
        
        <label for="" class="form-label">Category</label>
        <select name="category_id"class="form-select" aria-label="Default select example">
            <option selected >Open this select menu</option>
            @foreach($cats as $cat)
            <option name="category_id" value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
        </select>
        
        <label for="" class="form-label">Description</label>
        <input type="text" name="description" class="form-control" id="">
        
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input class="form-control" type="file" id="formFile" name="image">
        </div>

        <label for="" class="form-label">Price</label>
        <input type="number" name="price" class="form-control" id="">

        <label for="" class="form-label">Stock</label>
        <input type="number" name="stock" class="form-control" id="">
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