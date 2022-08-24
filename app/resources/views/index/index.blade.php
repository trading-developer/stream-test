@extends('layouts.main')
@section('content')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Активных стримов - {{$countActiveLiveStream}}</h1>
                <p class="lead text-muted">Смотри стримы наших лучших игроков и повторяй то что они делают.</p>

                @auth
                    <a href="{{ route('broadcast.create') }}" class="btn btn-primary my-2">Добавить стрим</a>
                    <a href="{{ route('logout.logout') }}" class="btn btn-primary my-2">
                        {{auth()->user()->name}}
                        Выйти</a>
                @endauth

                @guest
                    <a href="{{ route('register.show') }}" class="btn btn-primary my-2">Регистрация</a>
                    <a href="{{ route('login') }}" class="btn btn-secondary my-2">Авторизация</a>
                @endguest
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($broadcasts as $broadcast)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img width="100%" height="350" src="{{asset('/asset/images/prew.png')}}" alt="">
                            <div class="card-body">
                                <p class="card-title">{{ $broadcast['name'] }}</p>
                                <p class="card-text">{{ $broadcast['description'] }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('broadcast.show', ['id' => $broadcast['id']]) }}"
                                           class="btn btn-sm btn-outline-primary">View</a>
                                    </div>
                                    <small class="text-muted">{{ $broadcast['created_at'] }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
