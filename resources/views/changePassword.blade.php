@extends('layout.template')

@section('main-content')

<div class="container shadow p-3 bg-white rounded">
    <h1 class="Card-title">Change Password</h1>
    <form action="{{route('change_password')}}" method="post">
        @csrf
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td colspan="10">Old Password</td>
                    <td>
                        <input type="password" class="form-control" name="old_pass">
                    </td>
                </tr>
                <tr>
                    <td colspan="10">New Password</td>
                    <td>
                        <input type="password" class="form-control" name="new_pass">
                    </td>
                </tr>
                <tr>
                    <td colspan="10">New Configuration Password</td>
                    <td>
                        <input type="password" class="form-control" name="conf_pass">
                    </td>
                </tr>
                <tr>
                    <td colspan="10">
                        <input type="submit" name="submit" value="Update" class="btn btn-primary">
                    </td>
                </tr>
            </tbody>
        </table>
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



@endsection
