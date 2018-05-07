@extends('layouts.adminlayout')

@section('content')
   <form method='POST' action='{{route('editRole')}}'>
        {{csrf_field()}}
        <div class='form-group'>
            <input type='hidden' value='{{ $role->id}}'  name='role_id'/>
            <label for='rolename'>
                Role Name:
            </label>
            <input type='text' name='role' required 
            pattern="[a-z]{3,15}" 
            title='Only lower case latters are allowed (min is 3chars, max is 15 chars)'
            value='{{ $role->role_name}}'
            />
        </div>
        <div>
            <input type='submit' class='btn btn-primary' name='btnEdit' value='Edit' />
        </div>
   </form>
@endsection

