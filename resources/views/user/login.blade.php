@extends('layouts.main')

@section('title', 'Home page')

@section('container')

<h1 class="h2">Login Form</h1>


<form action="{{route('login.auth')}}" method="post">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input name="name" type="text" class="form-control" id="name" placeholder="name@example.com">

    </div>

    <div class="mb-3">
        <label for="password" class="form-label">password</label>
        <input name="password" type="password" class="form-control" id="password" placeholder="Пороль">

    </div>

    <div class="mb-3 form-check">
        <input name="remember" class="form-check-input" type="checkbox" id="remember">
        <label class="form-check-label" for="remember">
            Remember me
        </label>
    </div>

    <button type="submit" class="btn btn-primary">Авторизоваться</button>


</form>

@endsection