@extends('layouts.main')

@section('container')

<div class="container p-5">
    <form action="{{route('post.store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Название</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                placeholder="Название мероприятия">
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание мероприятия</label>
            <input name="description" type="text" class="form-control @error('description') is-invalid @enderror"
                id="description" placeholder="Описание мероприятия">

        </div>

        <div class="mb-3 form-group">
            <label for="categories_id" class="form-label">Выбери категории:</label>
            <select name="categories_id[]" class="form-group" id="categories_id" multiple required>
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="btn btn-primary">Добавить запланированное мероприятие</button>
    </form>
</div>

@endsection