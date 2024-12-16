@extends('layouts.master')

@section('content')

<!-- Hero Section -->
<section class="hero" style="background-color: #F4F4F2; color: #736960; text-align: center; padding: 3rem 0; background-image: url('/images/hero-bg.png'); background-size: cover; background-position: center;">
    <div class="container">
        <h1>Welcome to Spectacle Studio!</h1>
        <p>Your one-stop shop for stylish and affordable eyewear.</p>
        <a href="{{ route('products.all') }}" class="btn btn-light btn-lg">Browse Products</a>
    </div>
</section>


<!-- Featured Categories Section -->
<section class="categories py-5" style="background-color: #736960;">
    <div class="container text-center">
        <h2 class="mb-5" style="color: #F4F4F2;">Explore Our Collections</h2>
        <div class="row justify-content-center">
            @foreach($cats as $cat)
                <div class="col-md-4 col-sm-6 mb-4">
                    <a href="{{ route('category.show', $cat->id) }}" class="text-decoration-none">
                        <div class="card border-0 shadow-sm" style="background-color: #F4F4F2; border-radius: 10px;">
                            <!-- Ensure all category images are .png -->
                            <img src="{{ asset('images/categories/' . $cat->name . '.png') }}" 
                                 alt="{{ $cat->name }}" 
                                 class="card-img-top" 
                                 style="height: 200px; object-fit: cover; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $cat->name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>


<!-- About Us Section -->
<section class="about py-5 bg-light">
    <div class="container text-center">
        <h2 class="mb-4">About Spectacle Studio</h2>
        <p class="lead mb-5">
        We offer a wide variety of stylish, high-quality eyewear designed to suit every occasion and lifestyle. Whether you're seeking trendy, fashion-forward sunglasses to elevate your look, or dependable prescription glasses that combine comfort with clear vision, we have something for everyone. Our collection features a diverse range of frames, styles, and lens options tailored to meet your unique needs, ensuring that you not only see better but also look your best. From classic, timeless designs to bold and modern trends, our eyewear is crafted with precision and care to deliver durability, functionality, and exceptional style. Explore our selection and discover the perfect pair to complement your personality, protect your eyes, and make every moment a little more stylish.</p>
    </div>
</section>

@endsection
