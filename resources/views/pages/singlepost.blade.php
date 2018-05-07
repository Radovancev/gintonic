@extends('layouts.homelayout')

@section('content')
<article>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto" style="margin-bottom:60px">
                {{ $singlePost->text }}
            </div>
          </div>
        </div>
        
</article>
<div class="col-lg-8 col-md-10 mx-auto">
@include('components.comments')
</div>
@endsection



