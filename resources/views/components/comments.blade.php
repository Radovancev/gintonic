

<div class='container' id='comments-container'>
    @if(count($comments))
        @foreach($comments as $comment)
        <div class="card my-4">
                <div class="card-header">
                    <strong>{{ $comment->username }}
                    </strong> <span class="text-muted">on {{ date('F d, Y h:i', $comment->posted_at) }}</span>
                </div>
                <div class="card-body">
                    {{ $comment->comment_text}}
                </div>
        </div>
        @endforeach
    @endif
</div>



<div class='container'>
@if(session()->has('user'))
<script>

</script>
<div class="card my-4">
    <input type='hidden' name='post_id'   value='{{ $singlePost->id }}' />
    <input type='hidden' name='root_path' value='{{  url('/') }}' />
        <h5 class="card-header">Leave a Comment:</h5>
        <div class="card-body">
            <div class="form-group">
              <textarea class="form-control" rows="3" id="comment"></textarea>
            </div>
            <button  class="btn btn-primary" id='btnSend'>Submit</button>
        </div>
</div>

@else
<div class="card my-4">
        <h5 class="card-header">Leave a Comment:</h5>
        <div class="card-body">

            <div class="form-group">
           
                Please <a href='{{route('login')}}'>Login in</a> to comment
         
            </div>
           
        </div>
</div>
@endif
<div>
        {{ $comments->links() }}
    <div>
</div>




@section('customScripts')
    <script src="{{ asset('js/moment.js') }}"> </script>
    <script src="{{ asset('js/ajax.js')}}"></script>  
    <script src="{{ asset('js/comments.js')}}"></script>  
@endsection

