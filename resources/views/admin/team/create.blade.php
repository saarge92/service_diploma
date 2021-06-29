@extends('layouts.admin')

@section('title')
    Добавить члена команды
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action={{ route('admin.team.create') }} method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>ФИО</label>
                    <input type="text" name="name" class="form-control" required>
                    @if ($errors->has('name'))
                        @if ($errors->has('name'))
                            <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                    @endif
                </div>
                <div class="form-group">
                    <label>Позиция</label>
                    <textarea name="position" class="form-control" rows="5" required></textarea>
                    @if ($errors->has('position'))
                        <div class="error">{{ $errors->first('position') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Ссылка ВК</label>
                </div>
                <div class="form-group">
                    <label>Изображение</label>
                    <input type="file" name="photo" accept="image/x-png,image/gif,image/jpeg" required>
                    @if ($errors->has('photo'))
                        <div class="error">{{ $errors->first('photo') }}</div>
                    @endif
                </div>
                <button type="submit" class="btn btn-danger">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
