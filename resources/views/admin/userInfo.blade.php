@extends('layouts.admin') 
@section('title') Информация о пользователе
@endsection
 
@section('content')
@include('executor.partials.info_modal')
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
    <div class="col-md-12">
        <label for="">Роли</label>
        <table class="table table-striped" id="rolesTable">
            @foreach($user->roles as $role)
            <tr>
                <td>
                    <span class="float-left nameExecutor">{{$role->name}}</span>
                </td>
                <td>
                    <button class="btn btn-danger float-right revokeRole"  data-role_id="{{$role->id}}">
                        <i class="fa fa-times"></i>
                        Удалить
                    </button>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-12">
        <input type="hidden" id="userId" value="{{ $user->id }}"> Добавить новую роль
        <div class="form-group">
            <select name="roles" id="roles" class="form-control">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <button id="grantRole" class="btn btn-warning">Даровать</button>
    </div>
</div>
@endsection
 
@section('scripts')
<script src="{{ URL::asset('admin/js/viewUser.js') }}"></script>
@endsection