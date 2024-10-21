@extends('layouts.main')


@section('container')

<div class="alert alert-info" role="alert">
    Спасибо за регистрацию. Подтвердите регистрацию с вашей почты
</div>
<div class="">
    Didnt receive the link
    <form action="{{route('verification.send')}}" method="post">
        @csrf
        <button type="submit" class="btn btn-link ps-0">Send Link</button>
    </form>
</div>

@endsection