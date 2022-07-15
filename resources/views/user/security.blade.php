@extends('layouts.main')

@section('title', 'Безопасность ' .$user->name)

@section('content')
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class="subheader-icon fal fa-lock"></i> {{__('Безопасность')}}
            </h1>

        </div>
        <form action="{{route('user.editsecurity', $user->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>{{__('Обновление эл. адреса и пароля')}}</h2>
                            </div>

                            <div class="panel-content">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <!-- email -->
                                <div class="form-group">
                                    <label class="form-label" for="email">{{__('Email')}}</label>
                                    <input type="text" id="email" class="form-control" value="{{$user->email}}" name="email">
                                    @error('email')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <!-- password -->
                                <div class="form-group">
                                    <label class="form-label" for="password">{{__('Пароль')}}</label>
                                    <input type="password" id="password" class="form-control" name="password">
                                </div>

                                <!-- password confirmation-->
                                <div class="form-group">
                                    <label class="form-label" for="password_confirmation">{{__('Подтверждение пароля')}}</label>
                                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation">
                                </div>


                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button type="submit" class="btn btn-warning waves-effect waves-themed">{{__('Изменить')}}</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection
