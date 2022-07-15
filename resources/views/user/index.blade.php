@extends('layouts.main')

@section('title', 'Список пользователей')

@section('content')
    <main id="js-page-content" role="main" class="page-content mt-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-users'></i> {{__('Список пользователей')}}
            </h1>
        </div>
        <div class="row">
            <div class="col-xl-12">

                @if(auth()->user()->is_admin)
                    <a class="btn btn-success" href="{{route('user.create')}}">{{__('Добавить')}}</a>
                @endif

                <div class="border-faded bg-faded p-3 mb-g d-flex mt-3">
                    <input type="text" id="js-filter-contacts" name="filter-contacts" class="form-control shadow-inset-2 form-control-lg" placeholder="{{__('Найти пользователя')}}">
                    <div class="btn-group btn-group-lg btn-group-toggle hidden-lg-down ml-3" data-toggle="buttons">
                        <label class="btn btn-default active">
                            <input type="radio" name="contactview" id="grid" checked="" value="grid"><i class="fas fa-table"></i>
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" name="contactview" id="table" value="table"><i class="fas fa-th-list"></i>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="js-contacts">
            @foreach($users as $user)
                <div class="col-xl-4">
                <div id="c_1" class="card border shadow-0 mb-g shadow-sm-hover" data-filter-tags="{{strtolower($user->name)}}">
                    <div class="card-body border-faded border-top-0 border-left-0 border-right-0 rounded-top">
                        <div class="d-flex flex-row align-items-center">
                            @if(isset($user->status['class']))
                                <span class="status status-{{$user->status['class']}} mr-3">
                            @endif
                                    <span class="rounded-circle profile-image d-block " style="background-image:url({{$user->getAvatar()}}); background-size: cover;"></span>
                                </span>
                            <div class="info-card-text flex-1 ml-2">
                                <a href="{{route('user.show', $user->id)}}" class="fs-xl text-truncate text-truncate-lg text-info">
                                    {{$user->name}}
                                    @if($user->is_admin)
                                        (admin)
                                    @endif
                                </a>

                                @if(auth()->user()->is_admin or auth()->user()->id === $user->id)
                                    <a href="javascript:void(0);" class="fs-xl text-truncate text-truncate-lg text-info" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fal fas fa-cog fa-fw d-inline-block ml-1 fs-md"></i>
                                        <i class="fal fa-angle-down d-inline-block ml-1 fs-md"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('user.edit', $user->id)}}">
                                            <i class="fa fa-edit"></i>
                                            {{__('Редактировать')}}</a>
                                        <a class="dropdown-item" href="{{route('user.security', $user->id)}}">
                                            <i class="fa fa-lock"></i>
                                            {{__('Безопасность')}}</a>
                                        <a class="dropdown-item" href="{{route('user.status', $user->id)}}">
                                            <i class="fa fa-sun"></i>
                                            {{__('Установить статус')}}</a>
                                        <a class="dropdown-item" href="{{route('user.media', $user->id)}}">
                                            <i class="fa fa-camera"></i>
                                            {{__('Загрузить аватар')}}
                                        </a>
                                        <a href="{{route('user.delete', $user->id)}}" class="dropdown-item"
                                           onclick="return confirm('are you sure?');
                                            e.preventDefault();
                                            document.getElementById('delete_form').submit();">
                                            <i class="fa fa-window-close"></i>
                                            {{__('Удалить')}}
                                        </a>
                                        <form action="{{route('user.delete', $user)}}" method="POST" id="delete_form">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                @endif

                                <span class="text-truncate text-truncate-xl">{{$user->workplace}}</span>
                            </div>
                            <button class="js-expand-btn btn btn-sm btn-default d-none" data-toggle="collapse" data-target="#c_1 > .card-body + .card-body" aria-expanded="false">
                                <span class="collapsed-hidden">+</span>
                                <span class="collapsed-reveal">-</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0 collapse show">
                        <div class="p-3">
                            <a href="tel:{{$user->phone}}" class="mt-1 d-block fs-sm fw-400 text-dark">
                                <i class="fas fa-mobile-alt text-muted mr-2"></i> {{$user->phone}}</a>
                            <a href="mailto:{{$user->email}}" class="mt-1 d-block fs-sm fw-400 text-dark">
                                <i class="fas fa-mouse-pointer text-muted mr-2"></i> {{$user->email}}</a>
                            <address class="fs-sm fw-400 mt-4 text-muted">
                                <i class="fas fa-map-pin mr-2"></i> {{$user->adress}}</address>
                            <div class="d-flex flex-row">
                                <a href="{{$user->vk}}" class="mr-2 fs-xxl" style="color:#4680C2">
                                    <i class="fab fa-vk"></i>
                                </a>
                                <a href="{{$user->tg}}" class="mr-2 fs-xxl" style="color:#38A1F3">
                                    <i class="fab fa-telegram"></i>
                                </a>
                                <a href="{{$user->inst}}" class="mr-2 fs-xxl" style="color:#E1306C">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>
@endsection
