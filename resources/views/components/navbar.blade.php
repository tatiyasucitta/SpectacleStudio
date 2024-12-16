<nav class="navbar navbar-expand-lg" style="background-color: #736960;">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href="/">Spectacle Studio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @if(auth()->check() && auth()->user()->isAdmin === 1)
                    <li class="nav-item">
                        <a href="{{ route('adminhome') }}" class="nav-link text-light">Admin Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{route('createitem')}}">Upload New Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{route('createcategory')}}">Create Category</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('products.all') }}" class="nav-link text-light">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light {{ request()->is('categories') ? 'active' : '' }}" href="{{ route('categories') }}">Shop by Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light {{ request()->is('cart') ? 'active' : '' }}" href="{{ route('cart.view') }}">Cart</a>
                    </li>
                    <a class="nav-link text-light" aria-current="page" href="{{route('history')}}">Facture History</a>
                @endif
            </ul>
        </div>
        <div class="nav-left">
            <ul class="navbar-nav">
                @if(!Auth::user())
                    <li class="nav-item">
                        <a class="nav-link text-light {{ request()->is('/') ? 'active' : '' }}" href="{{ route('login') }}">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light {{ request()->is('/') ? 'active' : '' }}" href="{{ route('register.form') }}">Sign Up</a>
                    </li>
                @else
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <li class="nav-item">
                            <button class="nav-link btn btn-light" style="background-color: #F4F4F2;" type="submit">Log Out</button>
                        </li>
                    </form>
                @endif
            </ul>
        </div>
    </div>
</nav>
