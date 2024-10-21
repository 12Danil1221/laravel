@extends('layouts.main')

@section('container')


<div class="container">
    <div class="row">
        <div class="col">
            <h1>Admin Panel</h1>
            <div class="row">
                <div class="col">
                    <h3>Пользователи</h3>
                    @foreach($users as $user)
                    <div class=" card-header-main mx-3" style="width: 12rem;">
                        <div class="card-deck p-2 ">
                            <div class="card p-3 border border-1px text-center" style="width: 12rem;">
                                <h2 class="mb-2">{{$user->name}}</h2>
                                <p class="mb-2">{{$user->description}}</p>
                                <form action="{{route('user.destroy', $user->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                </form>
                                <a type="submit" class="btn btn-primary mt-2"
                                    href="{{route('admin.edit', $user)}}">Редактировать</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col">
                    <h3>Мероприятия</h3>
                    @foreach($posts as $post)
                    <div class=" card-header-main mx-3" style="width: 12rem;">
                        <div class="card-deck p-2 ">
                            <div class="card p-3 border border-1px text-center" style="width: 12rem;">
                                <h2 class="mb-2">{{$post->name}}</h2>
                                <p class="mb-2">{{$post->description}}</p>
                                <form action="{{route('post.destroy', $post->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col">
                    <h3>Категории</h3>

                    @foreach ($categories as $category)
                    <h3>{{$category->name}}</h3>
                    <form action="{{route('category.destroy', $category->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                    <a type="submit" class="btn btn-primary mt-2"
                        href="{{route('admin.editcategory', $category)}}">Редактировать</a>

                    @endforeach

                </div>
                <div class="col">
                    <h2>Записи на мероприятия</h2>
                    @foreach ($registrations as $registration)

                    <p class="m-2">Имя пользователя: {{$registration->user->name}}
                        <hr>Запись на мероприятие:
                        {{$registration->post->name}}
                    </p>
                    <br>

                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>

@endsection