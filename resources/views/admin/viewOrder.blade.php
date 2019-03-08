@extends('layouts.admin') 
@section('title')
@endsection
 <style>
     .revokeExecutor
     {
         color:red;
     }
 </style>
@section('styles')
@endsection
 
@section('content')
<div id="shopInfo">
    <input type="hidden" id="orderId" value="{{ $order->id }}">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <label style="text-decoration:underline;">Исполнители</label>
                <div id="executors-block">
                    @foreach ($executors as $ex)
                    <div>
                        <span class="float-left">{{$ex->name}}</span>
                        <span class="float-right revokeExecutor"  data-order_id="{{$ex->id}}"><i class="fa fa-times"></i></span>
                        {{-- <ul class="list-inline" id="list-executor" style="float:right;color:red">
                        <li class="list-inline-item revokeExecutor"><i class="fa fa-times"  data-order_id="{{$ex->id}}"></i></li>
                        </ul> --}}
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
    </div>
</div>
@endsection
 
@section('scripts')
<script type="text/javascript" src="{{URL::asset('admin/js/viewOrder.js')}}"></script>
@endsection