@extends('layouts.client') 
@section('title') Новые заявки
@endsection
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <table class="table table-striped">
                <tr>
                    <th>
                        Название
                    </th>
                    <th>
                        Краткое содержимое
                    </th>
                </tr>
                @foreach ($orders as $order)
                <tr>
                    <td>
                        Заявка #{{$order->id}}
                    </td>
                    <td>
                        {{$order->previewText}}
                    </td>
                </tr>
                @endforeach
                <table>
        </div>
    </div>
</div>
@endsection