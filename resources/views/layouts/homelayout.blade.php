<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Nikola Radovancev">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@section('title')Gin-Tonic @show</title>
    

        {{-- Bootstrap core CSS  --}} 
        <link href='{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}' rel="stylesheet">

        {{-- Custom fonts for this template --}}
        @section('loadFonts')
            <link href='{{ asset('vendor/font-awesome/font-awesome.min.css') }}' rel="stylesheet" type="text/css">
            <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
            <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        @show

        {{-- Custom styles for this template --}} 
        @section('loadCustomCss')
            <link href="{{ asset('css/clean-blog.css') }}" rel="stylesheet">
        @show

    </head>

    <body>

        @include('components.header')

        
        <div class="container">
            @include('components.messages')
            @isset($message)
                
            @endisset
            @yield('content')
        </div>

        @include('components.footer')
        <script id="baseurl" type="text/template-baseurl">{{ url('/') }}</script>
        <script id="csrf" type="text/template-csrf">{{ csrf_token() }}</script>     
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
       
        @section('customScripts')
            
        @show
    </body>

</html>