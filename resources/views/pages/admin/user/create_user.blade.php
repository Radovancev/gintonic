@extends('layouts.adminlayout')

@section('content')

        <form method='POST'  action = "{{ route('createUser') }}" >
            {{ csrf_field() }}
            <div class='form-group'>
                <label for='email'>Email address:</label>
                <input 
                    type='email' 
                    class='form-control' 
                    name='email' 
                    placeholder='Enter email'
                    required = 'true'
                    
                />
            </div>

            <div class='form-group'>
                    <label for='username'>Username:</label>
                    <input 
                        type='text' 
                        class='form-control' 
                        name='username' 
                        placeholder='Enter Username'
                        required = 'true'
                        pattern  = '[A-Z][\d\w]{5,12}'
                        title    = 'Username Must start with Captial later and be atlest 6 chars long'
                        
                    />
                </div>

            <div class='form-group'>
                    <label for='password'>Password:</label>
                    <input 
                        type        ='password' 
                        class       ='form-control' 
                        name        ='password' 
                        placeholder ='Enter password'
                        required    = 'true'
                        pattern     ="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
                        title       ="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters"
                    />
            </div>
            <div class='form-group'>
                    <label for='role'>Role:</label>
                    <select class='selectpicker' name='role' required>
                    @foreach($roles as $role)
                        <option value='{{$role->id}}'>{{$role->role_name}}</option>
                    @endforeach
                    </select>
            </div>


            <button type='submit' class='btn btn-primary' name='btnCreate'>Create New User</button>
        </form>

@endsection