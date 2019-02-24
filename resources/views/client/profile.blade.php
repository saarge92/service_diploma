@extends('layouts.client') 
@section('content')
<div class="container">
    <h3>Измените ваш профиль</h3>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('client.changeProfile')}}" method="POST">
                <div class="form-group">
                    <label for="name">ФИО</label>
                    <input type="text" name="name" class="form-control" value="{{$user->name}}" />
                </div>
                <div class="form-group">
                    <label for="address">Адрес</label>
                    <input type="text" class="form-control" name="address" value="{{$user->address}}">
                </div>
                <div class="form-group">
                    <label for="address">Организация</label>
                    <input type="text" class="form-control" name="organization" value="{{$user->organization}}">
                </div>
                <div class="form-group">
                    <label for="address">Телефон</label>
                    <input type="text" class="form-control" name="phone_number" value="{{$user->phone_number}}">
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-success">Изменить</button>
            </form>
        </div>
    </div>
</div>
@endsection