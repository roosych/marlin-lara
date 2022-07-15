@extends('layouts.main')

@section('title', 'Статус ' .$user->name)

@section('content')
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class="subheader-icon fal fa-sun"></i> {{__('Установить статус')}}
            </h1>

        </div>
        <form action="{{route('user.setstatus', $user->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>{{__('Установка текущего статуса')}}</h2>
                            </div>
                            <div class="panel-content">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- status -->
                                        <div class="form-group">
                                            <label class="form-label" for="example-select">{{__('Выберите статус')}}</label>
                                            <select class="form-control" id="example-select" name="status_id">
                                                @foreach($statuses as $status)
                                                    <option value="{{$status->id}}" {{$user->status_id == $status->id ? 'selected' : ''}}>{{$status->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                        <button type="submit" class="btn btn-warning waves-effect waves-themed">{{__('Установить')}}</button>
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
