@extends('layouts.admin') 
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card-header">
            Статусы заявок
        </div>
        <div class="card-body">
            <form method="GET" action="{{route('admin.all-requests')}}">
                <div class="form-group">
                    <select name="statusId" id="orderSelect" class="form-control">
                        @foreach ($statuses as $status)
                            <option value="{{$status->id}}" 
                                {{isset($_GET['statusId']) ?  ($_GET['statusId'] == $status->id ? 'selected' : '') : ''}}>
                                {{$status->name}}
                            </option>
                        @endforeach
                        <option value="" 
                            {{ isset($_GET['statusId']) ? ($_GET['statusId'] == null ? 'selected' : '') : 'selected'}} >Новая</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Применить</button>
            </form>
        </div>
    </div>
</div>
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
                <th>
                    Исполнители
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
                    {{ $order->totalQty }}
                </td>
                <td>
                    {{ $order->totalSum }}
                </td>
                <td>{{ $order->status }}</td>
                <td>
                    {{ $order->created_at }}
                </td>
                <td>
                    {{ $order->updated_at }}
                </td>
                <td>
                    @foreach ($order->executors as $item) {{ $item }} @endforeach
                </td>
                <td>
                    <a href="{{route('admin.viewOrder',['id'=>$order->id])}}" class="btn btn-danger">Посмотреть</a>
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