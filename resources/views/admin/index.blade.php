@extends('layouts.admin')

@section('title')
Список пользователей
@endsection 

@section('content')

<div class="row">
    <div class="col-md-12">
        <a href="{{route('admin.createUser')}}" class="btn btn-success">
            <i class="fas fa-plus"></i>
            Добавить пользователя
        </a>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <label for="">Фильтры</label>
        <form method="GET" action="/admin/index">
            <div class="form-group">
                <select name="roleId" class="form-control">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id}}" {{ isset($_GET['roleId']) ? ($_GET['roleId'] == $role->id ? 'selected' : '') : '' }} >{{$role->name }}</option>
                    @endforeach
                    <option value="" {{ empty($_GET['roleId']) ? 'selected' : '' }}  >Клиент</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-danger">Подтвердить</button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-condensed">
            <tr>
                <th>
                    Имя пользователя
                </th>
                <th>
                    Почта
                </th>
                <th>
                    Роли
                </th>
            </tr>
            @foreach ($users as $user)
            <tr>
                <td>
                    <a href="{{ route('admin.viewUser',['userId'=>$user->id]) }}">{{ $user->name }}</a>
                </td>
                <td>
                    {{$user->email}}
                </td>
                <td>
                    @if(!$user->hasRoles()) Клиент @else @foreach ($user->roles()->get() as $role)
                    <?php echo $role->name . '<br>'; ?> @endforeach @endif
                </td>
                <td>
                    <button class="btn btn-danger deleteUser" data-user_id={{$user->id}}>
                        <i class="fas fa-times"></i>
                        Удалить
                    </button>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<div class="row mt-2 text-center">
    <div class="col-md-12">
        {{$users->appends(request()->input())->links()}}
    </div>
</div>
@endsection
 
@section('scripts')
<script src="{{URL::asset('admin/js/deleteUser.js')}}"></script>
@endsection