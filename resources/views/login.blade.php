@extends('layout.template')

@section('main-content')

<div class="card shadow mx-auto p-3 bg-white rounded" style="width: 20rem;" id="login">
    <div class="card-body">
        <h3 class="card-title">Login</h3>
        <form action="{{route('login_user')}}" method="post">
            @csrf
            <div class="form">
                @if (Cookie::get('users'))
                    <input type="email" placeholder="Email" class="form-control" name="email" value="{{Cookie::get('users')}}">
                @else
                    <input type="email" placeholder="Email" class="form-control" name="email">
                @endif
            </div>
            <div class="form">
                <input type="password" placeholder="Password" class="form-control" name="password">
            </div>
            <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" value="remember" name="remember">
                <label class="form-check-label">
                    Remember Me
                </label>
            </div>
            <div class="form">
                <input type="submit" placeholder="Login" class="form-control btn btn-primary" value="Login">
            </div>
        </form>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('Success'))
            <div class="alert alert-success">
                {{ session('Success') }}
            </div>
        @endif
    </div>
</div>

@endsection
