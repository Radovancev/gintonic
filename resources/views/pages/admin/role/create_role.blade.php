@extends('layouts.adminlayout')

@section('content')
   <form method='POST' action='{{route('createRole')}}'>
        {{csrf_field()}}
        <div class='form-group'>
            <label for='rolename'>
                Role Name:
            </label>
            <input type='text' name='role' required 
            pattern="[a-z]{3,15}" 
            title='Only lower case latters are allowed (min is 3chars, max is 15 chars)'
            />
        </div>
        <div>
            <input type='submit' class='btn btn-primary' name='btnSubmit' value='Create' />
        </div>
   </form>
@endsection

