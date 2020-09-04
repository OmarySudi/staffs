<!-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        Fonts 
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        Styles
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html> -->
@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">

        <div class="container">

            <div class="row">
           
              <!-- {{ $staffs }} -->

              @foreach($staffs as $staff)
            
                    <!-- <div class="card-transparent mr-5" style="width:120px;">
        
                        <img class="card-img-top" style="height:120px" src="">
                    
                        <p><strong>{{ $staff->full_name }}</strong></p>
                        
                    </div> -->

                    <!-- <div style="width:120px;" class="mr-5 mt-5">
                        <img class="card-img-top" style="height:120px" src="<?php echo asset("images/$staff->profile_picture_path")?>">
                        <p><strong>{{ $staff->full_name }}</strong></p>
                    </div> -->
                   
                        <div class="card mr-5 staff-card" style="width: 10rem;">
                            <a href="{{ route('staffs.staff-info',['id' => $staff->id])}}">
                                <img class="card-img-top" style="height:120px" src="<?php echo asset("images/$staff->profile_picture_path")?>" alt="Card image cap">
                                <div class="card-body pl-1">
                                    <span class="font-weight-bold">{{ $staff->full_name}}</span>
                                    <!-- <h5 class="card-title">Card title</h5>
                                    
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                </div>
                            </a>
                        </div>
                    
              @endforeach
            </div>
            
        </div>

    </div>
</div>
@endsection
