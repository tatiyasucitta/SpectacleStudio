@extends('layouts.master')

@section('content')
    <h2 style="padding: 20px 0; text-align: center; color: #736960;">Shop by Category</h2>
    <div class="container">
        <div class="row">
            @foreach($categories as $cat)
                <div class="col-md-4 col-sm-6 mb-4">
                    <a href="{{ route('category.show', $cat->id) }}" class="text-decoration-none">
                        <div class="card border-0 shadow-sm h-100">
                            <img src="{{ asset('images/categories/' . $cat->name . '.png') }}" alt="{{ $cat->name }}" class="card-img-top" style="height: 200px; object-fit: cover; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-dark text-center">{{ $cat->name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

