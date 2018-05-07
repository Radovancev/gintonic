@extends('layouts.adminlayout')

@section('content')

        <form method='POST'  action = "{{route('createImage')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class='form-group'>
                <label for='text'>Image Title:</label>
                <input 
                    type='text' 
                    class='form-control' 
                    name='title' 
                    placeholder='Enter image title'
                    required = 'true'
                    pattern="[A-Z][a-z]{2,14}"
                    title= "First char should be uppercase and only characters up to 15 min is 3"
                />
            </div>
            <div>
                <input type='file' name='image' accept="image/jpg, image/jpeg, image/png" required/>
            </div>
            <div class='form-group'>
                <label for='Featured'>Featured:</label>
                <select name='featured' required>
                    <option value='0' > No</option>
                    <option value='1' > Yes</option>
                </select>
            </div>


            <button type='submit' class='btn btn-primary' name='btnCreate'>Create new Gallery Image</button>
        </form>

@endsection