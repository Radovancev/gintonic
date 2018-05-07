@extends('layouts.adminlayout')

@section('content')
    <table class='table'>
        <tr>
            <th>Email</th>
            <th>Username</th>
            <th>Account Active</th>
            <th>Role</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    @foreach($users as $user)
        <tr>
            <td>{{$user->email}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->active?'Yes':'No'}}</td>
            <td>{{$user->role_name}}</td>
            <td><a href="{{ route('editUserForm', ['id' => $user->user_id])}}" class='btn btn-primary'>Edit</a></td>
            <td><a href="{{ route('deleteUser',   ['id' => $user->user_id])}}" class='btn btn-danger'>Delete</a></td>

        </tr>
    @endforeach
    </table>

    <div>
        <a href='{{route('createUserForm') }}' class='btn btn-primary'>Create New User </a>
    </div>
@endsection

