@extends('layouts.admin')

@section('title')
Создание услуги
@endsection

@section('content')
@if($service!=null)
<div class="row">
    <div class="col-md-12">
        <form action=<?php echo '/admin/postEditService/'.$service->id ?> method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Название услуги</label>
                <input type="text" name="title" value="{{ $service->title }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Описание</label>
                <textarea name="content" class="form-control" rows="5">{{ $service->content }}</textarea>
            </div>
            <div class="form-group">
                <label>Цена</label>
                <input type="number" name="price" class="form-control" value="{{ $service->price }}">
            </div>
            <div class="form-group">
                <label>Изображение</label>
                <input type="file" name="path" accept="image/x-png,image/gif,image/jpeg">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-danger">Редактировать</button>
            </div>
        </form>
    </div>
</div>
@endif
@endsection