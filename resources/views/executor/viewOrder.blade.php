@extends('layouts.executor') 
@section('title') Обзор заявки
@endsection
 
@section('styles')
<link rel="stylesheet" href="{{URL::asset('executor/css/viewOrder.css')}}">
@endsection
 
@section('content')
    @include('executor.partials.info_modal')
<div class="row">
    <div class="col-md-12">
        <form id="statusForm" action="" method="POST">
            <div class="form-group">
                <label>Установите статус</label>
                <select id="statusSelect" class="form-control">
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" {{ $order->status_id == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-danger" id="setUpStatus">Установить</button>
        </form>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <div>Комментарии</div>
        <div id="comments">
            @foreach($comments as $comment)
            <div class="comment">
                <label>Автор : {{$comment->user ? $comment->user->name : ''}}</label>
                <div class="comment-text">{{$comment->comments}}</div>
                <div>
                    Дата {{$comment->created_at}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="row mt-2 text-center">
    <div class="col-md-12">
        {{$comments->links()}}
    </div>
</div>

<!-- Если заказ не пустой -->
@if($order != new stdClass())
<div class="row mt-2">
    <div class="col-md-12">
        <div class="form-group">
            <input type="hidden" id="orderId" value="{{ $order->id }}">
            <label>Введите комментарий</label>
            <textarea id="textComment" class="form-control"></textarea>
        </div>
        <button class="btn btn-primary" id="addButton">Добавить</button>
    </div>
</div>
@else
<div class="row">
    <div class="col-md-12">
        Заявки не существует
    </div>
</div>
@endif
<!-- -->
@endsection
 
@section('scripts')
<script src="{{URL::asset('executor/js/viewOrder.js')}}"></script>
@endsection