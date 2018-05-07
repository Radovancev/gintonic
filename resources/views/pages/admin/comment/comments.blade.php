@extends('layouts.adminlayout')

@section('content')
    <table class='table'>
        <tr>
            <th>Text</th>
            <th>User</th>
            <th>Post</th>
            <th>Posted At</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    @foreach($comments as $comment)
        <tr>
        <td>
             {{ strlen($comment->comment_text) > 20? substr($comment->comment_text,0,20). '...' : $comment->comment_text}}
        </td>
            <td> {{$comment->username}} </td>
            <td> {{$comment->title}} </td>
            <td>{{date('F d, Y h:i', $comment->posted_at) }}</td>
            <td><a href="{{ route('deleteComment', ['id' => $comment->id])}}" class='btn btn-danger'>Delete</a></td>
            <th><a href="{{ route('editCommentForm', ['id' => $comment->id])}}" class='btn btn-primary'>Edit</a></th>
        </tr>
    @endforeach
    </table>

    <a href="{{route('createCommentForm')}}" class='btn btn-primary'>Add new comment</a>
@endsection
