@extends('layouts.adminlayout')

@section('content')

        <form method='POST'  action = "{{ route('createComment')}}" >
            {{ csrf_field() }}


            <div class='form-group'>
                <label>Comment text: </label>
                <textarea name='text'></textarea>
            </div>

            <div class='form-group'>
                <label>Author:</label>
                <select name='author' required>
                    @foreach($users as $author)
                        <option value="{{ $author->id}}" >{{ $author->username}} </option>
                    @endforeach
                </select>
            </div>

            <div class='form-group'>
                    <label>Post Title:</label>
                    <select name='post_id' required>
                        @foreach($posts as $post)
                            <option value="{{ $post->id}}" >{{ $post->title}} </option>
                        @endforeach
                    </select>
            </div>



            <button type='submit' class='btn btn-primary' name='btnCreate'>Create New Comment</button>
        </form>

@endsection