@extends('layouts.client') 
@section('title') Новые заявки
@endsection
 
@section('content')
<div class="card mb-4">
    <div class="card-header">
        Фильтры
    </div>
    <div class="card-body">
        <form method="GET" action="{{route('client.index')}}">
            <div class="form-group">
                <select name="orderId" id="orderSelect" class="form-control">
                    @foreach ($statuses as $status)
                        <option value="{{$status->id}}" 
                            {{isset($_GET['orderId']) ?  ($_GET['orderId'] == $status->id ? 'selected' : '') : ''}}>
                            {{$status->name}}
                        </option>
                    @endforeach
                    <option value="" 
                        {{ isset($_GET['orderId']) ? ($_GET['orderId'] == null ? 'selected' : '') : 'selected'}} >Новая</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Применить</button>
        </form>
    </div>
</div>
<div class="row">
    <div>
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
                    Дата создания
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