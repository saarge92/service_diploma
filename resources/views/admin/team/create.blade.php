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
                    <input type="text" name="title" class="form-control">
                    @if ($errors->has('name'))
                        @if ($errors->has('name'))
                            <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                    @endif
                </div>
                <div class="form-group">
                    <label>Позиция</label>
                    <textarea name="content" class="form-control" rows="5"></textarea>
                    @if ($errors->has('title'))
                        <div class="error">{{ $errors->first('content') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Цена</label>
                    <input type="number" name="price" class="form-control">
                    @if ($errors->has('price'))
                        @foreach($errors->get('price') as $error)
                            <div class="error">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
                <div class="form-group">
                    <label>Изображение</label>
                    <input type="file" name="path" accept="image/x-png,image/gif,image/jpeg">
                    @if ($errors->has('path'))
                        <div class="error">{{ $errors->first('path') }}</div>
                    @endif
                </div>
                <button type="submit" class="btn btn-danger">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
