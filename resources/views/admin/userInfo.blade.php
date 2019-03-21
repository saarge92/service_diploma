@extends('layouts.admin')
@section('title')
Информация о пользователе
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 text-center">
        <div>ФИО : {{ $user->name }}</div>
        <div>Организация : {{ $user->organization }}</div>
        <div>Телефон : {{ $user->phone_number }}</div>
        <div>Email: {{ $user->email }}</div>
        <div>Адрес {{ $user->address }}</div>
    </div>
</div>


<div class="row">
    <label for="">Роли</label>
    <div class="col-md-12">
        @foreach($user->roles as $role)
        <div>
            <span class="float-left nameExecutor">{{$role->name}}</span>
            <span class="float-right revokeExecutor"><i class="fa fa-times" data-user_id="{{$user->id}}"></i></span>
        </div>
        @endforeach
    </div>
</div>
@endsection 