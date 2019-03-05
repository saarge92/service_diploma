@extends('layouts.admin') 
@section('title') 
@endsection
 
@section('styles')
<style>
    .ajax-loader {
        position: fixed;
        top: 0;
        text-align: center;
        width: 100%;
        height: 100%;
        z-index: 10000;
        padding-top: 300px;
        vertical-align: middle;
        color: red;
        display: none;
    }
</style>
@endsection
 
@section('content')
<div id="shopInfo">
    <div class="container">
        <div class="row">
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
    </div>
</div>
@endsection