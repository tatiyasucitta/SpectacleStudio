@extends('layouts.master')

@section('content')
<head>    <link rel="stylesheet" href="{{asset('css/signin.css')}}">
</head>
<div class="container-fluid">
    <div class="row content-signin">
        <!-- Left side (logo section) -->
        <div class="col-md-6 left-side d-none d-md-flex">
            <div class="text-center">
                <img src="assets/[White] Spectacle Studio 2.png" alt="Spectacle Studio Logo" class="logo">
            </div>
        </div>

        <!-- Right side (form section) -->
        <div class="col-md-6 right-side">
            <div class="form-container">
                @if($errors->any())
                <p>
                    {{$errors->first()}}
                </p>
                @endif
                <label for="sign-in" class="form-header">Sign In</label>
                <form method=POST action="{{route('login.done')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-register">Log In</button>
                 </form>
            </div>
        </div>
    </div>
</div>
@endsection
