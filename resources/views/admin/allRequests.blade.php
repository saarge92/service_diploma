@extends('layouts.admin') 
@section('content')
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>
                    Название
                </th>
                <th>
                    Краткое содержимое
                </th>
                <th>
                    Кол-во услуг
                </th>
                <th>
                    Сумма
                </th>
                <th>
                    Статус заявки
                </th>
                <th>
                    Дата создания @if(isset($_GET['orderDate'])) @if($_GET['orderDate']=='asc')
                    <a href="{{route(request()->route()->getName(),array_merge(request()->except(['orderDate']),['orderDate'=>'desc']))}}">
                                <i class="fas fa-arrow-down"></i>
                            </a> @else
                    <a href="{{route(request()->route()->getName(),array_merge(request()->except(['orderDate']),['orderDate'=>'asc']))}}">
                                <i class="fas fa-arrow-up"></i>
                            </a> @endif @else
                    <a href="{{route(request()->route()->getName(),array_merge(request()->except(['orderDate']),['orderDate'=>'asc']))}}">
                        <i class="fas fa-arrow-up"></i></a> @endif
                </th>
                <th>
                    Дата изменения
                </th>
            </tr>
            @foreach ($orders as $order)
            <tr>
                <td>
                    Заявка #{{$order->id}}
                </td>
                <td>
                    @foreach($order->previewText as $prevText)
                    <?php echo $prevText . '<br/>' ;?> @endforeach
                </td>
                <td>
                    {{$order->totalQty}}
                </td>
                <td>
                    {{$order->totalSum}}
                </td>
                <td>{{$order->status}}</td>
                <td>
                    {{$order->created_at}}
                </td>
                <td>
                    {{$order->updated_at}}
                </td>
                <td>
                    <a href="{{route('client.getOrder',['id'=>$order->id])}}" class="btn btn-danger">Посмотреть</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-12">
        {{$orderPaginate->appends(request()->input())->links()}}
    </div>
</div>
@endsection