@extends('layouts.main')

@section('title', 'Медиа ' .$user->name)

@section('content')
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class="subheader-icon fal fa-image"></i> {{__('Загрузить аватар')}}
            </h1>

        </div>
        <form action="{{route('user.setavatar', $user->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>{{__('Текущий аватар')}}</h2>
                            </div>
                            <div class="panel-content">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <img src="{{asset($user->getAvatar())}}" alt="" class="img-responsive rounded-circle" width="200">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="avatar">{{__('Выберите аватар')}}</label>
                                    <input type="file" id="avatar" class="form-control-file" name="avatar">
                                    @error('avatar')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>


                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button type="submit" class="btn btn-warning waves-effect waves-themed">{{__('Загрузить')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection
