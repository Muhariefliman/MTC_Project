@extends('layout.template')

@section('main-content')

<div class="card shadow mx-auto p-3 bg-white rounded" style="width: 20rem;" id="register">
    <div class="card-body">
        <h3 class="card-title">Register</h3>
        <form action="{{route('reg_user')}}" method="post" class="mb-3">
            @csrf
            <div class="form">
                <input type="email" placeholder="Email" class="form-control" name="email">
            </div>
            <div class="form">
                <input type="text" placeholder="Full Name" class="form-control" name="name">
            </div>
            <div class="form">
                <input type="password" placeholder="Password" class="form-control" name="password">
            </div>
            <div class="form">
                <input type="password" placeholder="Confirmation Password" class="form-control" name="conf_password">
            </div>
            <div class="form">
                <input type="submit" placeholder="Register" class="form-control btn btn-primary" value="Register">
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
