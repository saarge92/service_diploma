@extends('layouts.admin') 
@section('title')
@endsection
 
@section('styles')
<link rel="stylesheet" href="{{URL::asset('executor/css/viewOrder.css')}}">
@endsection
 
@section('content')
    @include('executor.partials.info_modal')
<div id="shopInfo">
    <input type="hidden" id="orderId" value="{{ $order->id }}">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <label style="text-decoration:underline;">Исполнители</label>
                <div id="executors-block">
                    @foreach ($executors as $ex)
                    <div>
                        <span class="nameExecutor">{{$ex->name}}</span>
                        <span class="float-right revokeExecutor"><i class="fa fa-times"  data-user_id="{{$ex->id}}"></i></span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col col-md-12 col-sm-12 col-xs-12">
                <ul class="list-group">
                    @foreach($order->cart->items as $item)
                    <li class="list-group-item">
                        <span class="badge float-right order_qty">{{$item['qty']}}</span>
                        <strong>{{$item['item']['title']}}</strong>
                        <span class="label label-success current_price">{{$item['price']}} р</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="text-center">
            <strong><span id="totalPrice">Всего : {{$order->cart->totalPrice}}</span></strong><br/>
        </div>
        <div class="text-center">
            <a href="{{URL::previous() == URL::current() ? route('client.index') : URL::previous()}}" class="btn btn-primary">Назад</a>
        </div>

        @if($availableExecutors!=null)
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Назначить исполнителя</label>
                    <select class="form-control" id="executors">
                            @foreach ($availableExecutors as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" id="assignButton">Назначить</button>
                </div>
            </div>
        </div>
        @endif

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
                    <button class="btn btn-success" id="setUpStatus">Установить</button>
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
                        <button class="deleteButton" data-comment_id="{{$comment->id}}"> <i class="fas fa-times"></i> Удалить</button>
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
    </div>
</div>
@endsection
 
@section('scripts')
<script type="text/javascript" src="{{URL::asset('admin/js/viewOrder.js')}}"></script>
<script src="{{URL::asset('executor/js/viewOrder.js')}}"></script>
@endsection