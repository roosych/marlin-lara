@extends('layouts.main')

@section('title', 'Создать пользователя')

@section('content')
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class="subheader-icon fal fa-plus-circle"></i> {{__('Добавить пользователя')}}
            </h1>

        </div>
        <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>{{__('Общая информация')}}</h2>
                            </div>
                            <div class="panel-content">
                                <!-- username -->
                                <div class="form-group">
                                    <label class="form-label" for="name">{{__('Имя')}}</label>
                                    <input type="text" id="name" class="form-control" name="name" value="{{old('name')}}">
                                </div>

                                <!-- title -->
                                <div class="form-group">
                                    <label class="form-label" for="workplace">{{__('Место работы')}}</label>
                                    <input type="text" id="workplace" class="form-control" name="workplace" value="{{old('workplace')}}">
                                </div>

                                <!-- tel -->
                                <div class="form-group">
                                    <label class="form-label" for="phone">{{__('Номер телефона')}}</label>
                                    <input type="text" id="phone" class="form-control" name="phone" value="{{old('phone')}}">
                                </div>

                                <!-- address -->
                                <div class="form-group">
                                    <label class="form-label" for="adress">{{__('Адрес')}}</label>
                                    <input type="text" id="adress" class="form-control" name="adress" value="{{old('adress')}}">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>{{__('Безопасность и Медиа')}}</h2>
                            </div>
                            <div class="panel-content">
                                <!-- email -->
                                <div class="form-group">
                                    <label class="form-label" for="email">{{__('Email')}}</label>
                                    <input type="text" id="email" class="form-control" name="email" value="{{old('email')}}">
                                    @error('email')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <!-- password -->
                                <div class="form-group">
                                    <label class="form-label" for="password">{{__('Пароль')}}</label>
                                    <input type="password" id="password" class="form-control" name="password">
                                    @error('password')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>


                                <!-- status -->
                                <div class="form-group">
                                    <label class="form-label" for="status">{{__('Выберите статус')}}</label>
                                    <select class="form-control" id="status" name="status_id">
                                        <option value="">{{__('Выберите из списка')}}</option>
                                        @foreach($statuses as $status)
                                            <option value="{{$status->id}}">{{$status->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="avatar">{{__('Загрузить аватар')}}</label>
                                    <input type="file" id="avatar" class="form-control-file" name="avatar">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xl-12">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>{{__('Социальные сети')}}</h2>
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- vk -->
                                        <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-right-0 py-1 px-3">
                                                    <span class="icon-stack fs-xxl">
                                                        <i class="base-7 icon-stack-3x" style="color:#4680C2"></i>
                                                        <i class="fab fa-vk icon-stack-1x text-white"></i>
                                                    </span>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control border-left-0 bg-transparent pl-0" name="vk" value="{{old('vk')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- telegram -->
                                        <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-right-0 py-1 px-3">
                                                    <span class="icon-stack fs-xxl">
                                                        <i class="base-7 icon-stack-3x" style="color:#38A1F3"></i>
                                                        <i class="fab fa-telegram icon-stack-1x text-white"></i>
                                                    </span>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control border-left-0 bg-transparent pl-0" name="tg" value="{{old('tg')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- instagram -->
                                        <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-right-0 py-1 px-3">
                                                    <span class="icon-stack fs-xxl">
                                                        <i class="base-7 icon-stack-3x" style="color:#E1306C"></i>
                                                        <i class="fab fa-instagram icon-stack-1x text-white"></i>
                                                    </span>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control border-left-0 bg-transparent pl-0" name="inst" value="{{old('inst')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                        <button type="submit" class="btn btn-success waves-effect waves-themed">{{__('Добавить')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection
