@include('components.navigation')
<header class="masthead" 
        style="background-image: 
        @isset($singlePost)
        url('{{ asset($singlePost->cover_image) }}')">

        @else 
          url('{{asset('img/home-bg.jpg') }}')">
        @endisset
        
        
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
            
          @isset($singlePost)
            <h1 style="font-size:43px">{{ $singlePost->title }}</h1>
            
          @else
            <h1>Gin-tonic blog</h1>
            <span class="subheading">If you love me, drink me.</span>
            <span class="subheading">If you don't, leave this page.</span>

          @endisset
        </div>
      </div>
    </div>
  </div>
</header>