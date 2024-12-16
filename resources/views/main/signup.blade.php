@extends('layouts.master')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/signup.css')}}">
</head>

<div class="container-fluid">
    <div class="row content-signup">
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
                <label for="sign-up" class="form-header">Sign Up</label>
                <form method=POST action="{{route('register')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirmpassword" required>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="termsCheck" required>
                        <label class="form-check-label" for="termsCheck">
                            I agree to the terms and conditions
                        </label>
                    </div>
                    <button type="submit" class="btn btn-register">Register</button>
                 </form>
            </div>
        </div>
    </div>
</div>
@endsection
