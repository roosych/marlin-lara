@extends('layouts.main')

@section('title', 'Редактировать ' .$user->name)

@section('content')

<main id="js-page-content" role="main" class="page-content mt-3">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class="subheader-icon fal fa-plus-circle"></i> {{__('Редактировать')}}
        </h1>

    </div>
    <form action="{{route('user.update', $user->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xl-6">
                <div id="panel-1" class="panel">
                    <div class="panel-container">
                        <div class="panel-hdr">
                            <h2>{{__('Общая информация')}}</h2>
                        </div>
                        <div class="panel-content">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- username -->
                            <div class="form-group">
                                <label class="form-label" for="name">{{__('Имя')}}</label>
                                <input type="text" id="name" class="form-control" value="{{$user->name}}" name="name">
                            </div>

                            <!-- title -->
                            <div class="form-group">
                                <label class="form-label" for="workplace">{{__('Место работы')}}</label>
                                <input type="text" id="workplace" class="form-control" value="{{$user->workplace}}" name="workplace">
                            </div>

                            <!-- tel -->
                            <div class="form-group">
                                <label class="form-label" for="phone">{{__('Номер телефона')}}</label>
                                <input type="text" id="phone" class="form-control" value="{{$user->phone}}" name="phone">
                            </div>

                            <!-- address -->
                            <div class="form-group">
                                <label class="form-label" for="adress">{{__('Адрес')}}</label>
                                <input type="text" id="adress" class="form-control" value="{{$user->adress}}" name="adress">
                            </div>
                            <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-warning waves-effect waves-themed">{{__('Редактировать')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>

@endsection
