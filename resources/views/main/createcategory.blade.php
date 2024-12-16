@extends('layouts.master')

@section('content')
    <form action="{{route('createdcategory')}}" method="POST" style="margin:20px" enctype="multipart/form-data">
        @csrf
        <label for="" class="form-label">Category Name</label>
        <input type="text" name="categoryName" class="form-control" id="">
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input class="form-control" type="file" id="formFile" name="image">
        </div>
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