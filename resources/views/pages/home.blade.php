@extends('layouts.homelayout')

@section('title')
  @parent - Welcome
@endsection
@section('content')
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">

            @foreach($posts as $post)
              <div class="post-preview">
                <a href="{{route('singlePost', ['id' => $post->id]) }}">
                  <h2 class="post-title">
                    {{ $post->title }}
                  </h2>
                </a>
                <p class="post-meta">Posted by
                  <a href="">{{$post->username }}</a>
                  on {{ date('F d, Y', ($post->created)) }}</p>
              </div>
              <hr>

          
            @endforeach

          
          {{ $posts->links() }}
        
          </div>
      </div>

@endsection


