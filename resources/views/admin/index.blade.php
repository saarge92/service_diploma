@extends('layouts.admin') 
@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="GET" action="/admin/index">
            <div class="form-group">
                <select name="roleId" class="form-control">
                    @foreach ($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                    <option value="">Клиент</option>
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
                    {{$user->name}}
                </td>
                <td>
                    {{$user->email}}
                </td>
                <td>
                    @if(!$user->hasRoles()) Клиент @else @foreach ($user->roles()->get() as $role)
                    <?php echo $role->name . '<br>'; ?> @endforeach @endif
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