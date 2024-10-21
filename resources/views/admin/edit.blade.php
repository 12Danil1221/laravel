@extends('layouts.main')

@section('container')

<div class="container">
    <h1>Редактирование пользователя:</h1>
    <form action="{{route('admin.update', $user)}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                value="{{old('name')}}" id="name" placeholder="Name">
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                value="{{old('email', $user->email)}}" id="email" placeholder="Email">

        </div>




        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
</div>

@endsection