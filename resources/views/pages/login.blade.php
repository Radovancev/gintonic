@extends('layouts.homelayout')

@section('title')
  @parent - Login
@endsection

@section('content')

<form method='POST'  action='{{ route('login') }}'>
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
                    <label for='password'>Password:</label>
                    <input 
                        type='password' 
                        class='form-control' 
                        name='password' 
                        placeholder='Enter password'
                        required = 'true'
                    />
            </div>
            <button type='submit' class='btn btn-primary' name='btnLogin'>Login</button>
        </form>

@endsection
