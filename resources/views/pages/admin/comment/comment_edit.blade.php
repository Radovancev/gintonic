@extends('layouts.adminlayout')

@section('content')

        <form method='POST'  action = "{{ route('editComment')}}" >
            {{ csrf_field() }}
            <input type='hidden' value="{{$comment->id}}" name="comment_id" />
            <div class='form-group'>
                <label>Comment text: </label>
                <textarea name='text'>{{$comment->comment_text}}</textarea>
            </div>

            <div class='form-group'>
                <label>Author:</label>
                <select name='author' required>
                    @foreach($users as $author)
                    <option value="{{ $author->id}}" {{$author->id === $comment->user_id?'selected':""}}>
                            {{ $author->username}} 
                        </option>
                    @endforeach
                </select>
            </div>

            <div class='form-group'>
                    <label>Post Title:</label>
                    <select name='post_id' required>
                        @foreach($posts as $post)
                            <option value="{{ $post->id}}"  {{$post->id === $comment->post_id?'selected':""}}>
                                {{ $post->title}} 
                            </option>
                        @endforeach
                    </select>
            </div>



            <button type='submit' class='btn btn-primary' name='btnEdit'>Edit</button>
        </form>

@endsection