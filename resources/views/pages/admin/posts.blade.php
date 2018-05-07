@extends('layouts.adminlayout')

@section('content')
    <table class='table'>
        <tr>
            <th>Cover Image</th>
            <th>Title</th>
            <th>Posted By</th>
            <th>Post</th>
            <th>Posted At</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    @foreach($posts as $post)
        <tr>
            <td>
                Slika
            </td>
            <td> {{$post->title}} </td>
            <td> {{$post->username}} </td>
        <td>
             {{ strlen($post->text) > 20? substr($post->text,0,20). '...' : $post->text}}
        </td>

            <td>{{date('F d, Y h:i', $post->created) }}</td>
            <td><a href="{{ route('deletePost', ['id' => $post->id])}}" class='btn btn-danger'>Delete</a></td>
            <th>Edit</th>
        </tr>
    @endforeach
    </table>
@endsection
