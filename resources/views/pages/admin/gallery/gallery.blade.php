@extends('layouts.adminlayout')

@section('content')
    <table class='table'>
        <tr>
            <th>Img</th>
            <th>Title</th>
            <th>Featured</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    @foreach($images as $image)
        <tr>
            <td>
                <a href="{{asset($image->img_path) }}">
                    <img src="{{asset($image->img_path) }}" style='width:100px;height:100px' />
                </a>
            </td>
            <td> {{$image->title}} </td>
            <td> {{ $image->featured?'Yes':'No'}} </td>
            <td><a href="{{ route('deleteImage', ['id' => $image->id])}}" class='btn btn-danger'>Delete</a></td>
            <th><a href="{{ route('editImageForm', ['id' => $image->id])}}" class='btn btn-primary'>Edit</a></th>
        </tr>
    @endforeach
    </table>

    <div>
        <a href="{{ route('createImageForm') }}" class='btn btn-primary'> Add New Image</a>
    </div>
@endsection
