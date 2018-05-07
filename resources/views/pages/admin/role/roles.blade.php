@extends('layouts.adminlayout')

@section('content')
    <table class='table'>
        <tr>
            <th>Role</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    @foreach($roles as $role)
        <tr>
            <td>{{$role->role_name}}</td>
            <td><a href="{{ route('deleteRole', ['id' => $role->id])}}" class='btn btn-danger'>Delete</a></td>
            <td><a href="{{ route('editRoleForm', ['id' => $role->id])}}" class='btn btn-primary'>Edit</a></td>
        </tr>
    @endforeach
    </table>

    <div>
        <a href="{{ route('createRoleForm') }}" class='btn btn-primary'>Create new Role</a>
    <div>
@endsection

