@extends('layouts.main')

@section('title', 'Home page')

@section('container')
<div class="row">
    <div class="col text-center" style="min-width:10%">
        @auth
        <div class="container-navbar mb-3">
            <a href="{{route('post.create')}}" class="btn btn-success">Добавить мероприятие</a>
        </div>
        @endauth
        <hr>
        @foreach($posts as $post)
        <p>{{$post->name}}</p>
        <hr>
        @endforeach

    </div>
    <div class="col" style="min-width:85%">
        <h1 class="h2 text-center">Все мероприятия</h1>
        @auth()
        <div class="container">
            <div class="row">
                @foreach($posts as $post)
                <div class="card-header-main mx-3" style="width: 12rem;">
                    <div class="card-deck p-2 ">
                        <div class="card p-3 border border-1px text-center" style="width: 12rem;">
                            <h2 class="mb-2">{{$post->name}}</h2>
                            <p class="mb-2">{{$post->description}}</p>
                            <form action="{{route('register2', ['post' => $post->id])}}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{auth()->id()}}">
                                <button type="submit" class="btn btn-dark">Записаться на<br> мероприятие</button>
                            </form>
                        </div>


                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endauth

        @guest
        <div class="container">
            <div class="row">
                @foreach($posts as $post)
                <div class="card-header-main mx-3" style="width: 12rem;">
                    <div class="card-deck p-2 ">
                        <div class="card p-3 border border-1px text-center" style="width: 12rem;">
                            <h2 class="mb-2">{{$post->name}}</h2>
                            <p class="mb-2">{{$post->description}}</p>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        @endguest
    </div>
</div>

@endsection