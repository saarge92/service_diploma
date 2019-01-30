@extends('layouts.frontend') 
@section('title') Список услуг
@endsection
 
@section('styles')
<style>
    .order_qty {
        background-color: #af4900;
    }

    #shopInfo {
        margin-top: 7.5rem;
    }
</style>
@endsection

<div id="shopInfo">
    
@section('content') @if(Session::has('cart') && Session::get('cart')->totalQty>0)
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <ul class="list-group">
                    @foreach($orders as $order)
                    <li class="list-group-item">
                        <span class="badge pull-right order_qty">{{$order['qty']}}</span>
                        <strong>{{$order['item']['title']}}</strong>
                        <span class="label label-success current_price">{{$order['price']}} р</span>
                        <div class="btn btn-group">
                            <ul class="list-inline">
                                <li class="list-inline-item reduceOne"><i data-order_id="{{$order['item']['id']}}" class="fa fa-minus"></i></li>
                                <li class="list-inline-item increaseItem"><i class="fa fa-plus" data-order_id="{{$order['item']['id']}}"></i></li>
                                <li class="list-inline-item deleteAll"><i class="fa fa-trash" data-order_id="{{$order['item']['id']}}"></i></li>
                            </ul>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <strong><span id="totalPrice">Всего : {{$totalPrice}}</span></strong><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <button id="commit_order" type="button" class="btn btn-success">Подать заявку</button>
            </div>
        </div>
    </div>
    @else
    <div class="container">
        <div class="row">
            <div class="col col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <strong><span>Выбранные заявки отсутствуют</span></strong><br/>
                <a href="{{route('guest.index')}}/#services" class="btn btn-success">Выбрать услуги</a>
            </div>
        </div>
    </div>
    @endif
@endsection

</div>



@section('scripts')
<script>

</script>
@endsection