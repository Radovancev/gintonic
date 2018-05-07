@extends('layouts.homelayout')


@section('content')
    <div class="col-lg-12 col-md-10 mx-auto">
    <div class="row">
                    <div class="col-lg-6">
                    <img src="{{asset('img/author.jpg')}}"  alt="Author Image" />
            
                    </div>
            
                    <div class="col-lg-6">
                        <div class="jumbotron">
                        Hy there, I'm Nikola Radovancev. This site was made as project for PHP-Laravel course at Visoka ICT college.
                        </div>
                    </div>
                </div>
    </div>

@endsection()