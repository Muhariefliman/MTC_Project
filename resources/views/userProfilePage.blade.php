@extends('layout.template')

@section('main-content')

<div class="container shadow p-3 bg-white rounded">
    <h1 class="Card-title">Member&apos;s User Detail</h1>
    <form action="{{route('update_user_name')}}" method="post">
        @csrf
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td colspan="10">User Name</td>
                    <td>
                        <input type="text" class="form-control" name="user_name" value="{{Auth::user()->name}}">
                    </td>
                </tr>
                <tr>
                    <td colspan="10">User Email</td>
                    <td>
                        <input type="email" class="form-control" value="{{Auth::user()->email}}" disabled>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-8">
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
            <div class="col-2">
                <input type="submit" name="submit" value="Update" class="btn btn-primary form-control">
            </div>
            <div class="col-2">
                <a href="/changePassword" class="btn btn-primary">Change Password</a>
            </div>
        </div>
    </form>
</div>



@endsection
