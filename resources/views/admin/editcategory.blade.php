@extends('layouts.main')

@section('container')

<div class="container">
    <h1>Редактирование категории:</h1>
    <form action="{{route('admin.updatecategory', $category)}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Название категории</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                value="{{old('name')}}" id="name" placeholder="Name">
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
</div>

@endsection