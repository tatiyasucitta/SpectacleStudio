@extends('layouts.master')

@section('content')
    <h2 style="padding: 20px 0; text-align: center; color: #736960;">Shop by Category</h2>
    <div class="container">
        <div class="row">
            @foreach($categories as $cat)
                <div class="col-md-4 col-sm-6 mb-4">
                    <a href="{{ route('category.show', $cat->id) }}" class="text-decoration-none">
                        <div class="card border-0 shadow-sm" style="background-color: #F4F4F2; border-radius: 10px;">
                            <!-- Ensure all category images are .png -->
                            <img src="{{ $cat->image }}" 
                                 alt="{{ $cat->name }}" 
                                 class="card-img-top" 
                                 style="height: 200px; object-fit: cover; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $cat->name }}</h5>
                                @if(auth()->check() && auth()->user()->isAdmin === 1)
                                    <div class="action-div d-flex flex-row gap-2">
                                        <a href="{{ route('update.category.form', $cat->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('delete.category', $cat->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                @endif 
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

