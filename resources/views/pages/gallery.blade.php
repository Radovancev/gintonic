@extends('layouts.homelayout')



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />




@section('content')
	<div class="row text-center text-lg-left">

        @foreach($images as $image)
          <div class="col-lg-3 col-md-4 col-xs-6">
             <a href="{{ asset($image->img_path) }}" data-fancybox="images" data-caption="{{ $image->title}}" class="d-block mb-4 gallery" rel='gallery'>
             <img class="img-fluid img-thumbnail" style="width:400;height:300;" src="{{ asset($image->img_path) }}" alt="{{$image->title }}">
              </a>
          </div>
        @endforeach
	</div> <!-- row / end -->
@endsection


@section('customScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
    <script  type="text/javascript">
    $(document).ready(function(){
        $().fancybox({
          selector : '[data-fancybox="images"]',
          loop     : true
        });
    });
    </script>
@endsection

