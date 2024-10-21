@extends('layouts.main')

@section('title', 'Home page')

@section('container')

<h1 class="h2">Страница пользователя</h1>
@if($posts->isEmpty())
<p>У вас нету мероприятий!</p>
@else
<ul class="row">
    @foreach ($posts as $post)
    <li class="col">
        <h3>{{$post->name}}</h3>
        <p>{{$post->description}}</p>
        <form action="{{route('post.destroy', $post->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Удалить</button>
        </form>
        <a class="btn btn-primary mt-3" href="{{route('user.editpost', $post)}}">Редактировать</a>

    </li>
    @endforeach
</ul>
@endif
@endsection