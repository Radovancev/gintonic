@extends('layouts.adminlayout')

@section('content')

        <form method='POST'  action = "{{ route('editImage') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class='form-group'>
                <input type='hidden' name='img_id' value="{{$image->id }}" />
                <label for='text'>Image Title:</label>
                <input 
                    type='text' 
                    class='form-control' 
                    name='title' 
                    placeholder='Enter image title'
                    required = 'true'
                    pattern="[A-Z][a-z]{2,14}"
                    title= "First char should be uppercase and only characters up to 15 min is 3"
                    value = "{{ $image->title }}"
                />
            </div>
            <div>
               
                <img src="{{asset($image->img_path) }}" style="width:300px;300px" />
                
            </div>
            <div class='form-group'>
                    <label>Change Image</label>
                    <input type='file' name='image' accept="image/jpg, image/jpeg, image/png" required/>
            </div>
            <div class='form-group'>
                <label for='Featured'>Featured:</label>
                <select name='featured' required>
                    <option value='0' {{$image->featured?"":"selected"}}> No</option>
                    <option value='1' {{$image->featured?"selected":""}}> Yes</option>
                </select>
            </div>


            <button type='submit' class='btn btn-primary' name='btnEdit'>Edit</button>
        </form>

@endsection