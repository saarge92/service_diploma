@extends('layouts.executor') 
@section('title') Мои заявки
@endsection
 
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card-header">
            Статусы заявок
        </div>
        <div class="card-body">
            <form method="GET" action="{{route('executor.index')}}">
                <div class="form-group">
                    <select name="statusId" id="orderSelect" class="form-control">
                            @foreach ($statuses as $status)
                                <option value="{{$status->id}}" 
                                    {{isset($_GET['statusId']) ?  ($_GET['statusId'] == $status->id ? 'selected' : '') : ''}}>
                                    {{$status->name}}
                                </option>
                            @endforeach
                            <option value="" 
                                {{ isset($_GET['statusId']) ? ($_GET['statusId'] == 'new' ? 'selected' : '') : ''}} >Новая</option>
                            <option value="" {{ isset($_GET['statusId']) ? ($_GET['statusId'] == null ? 'selected' : '') : 'selected'}} >
                                Все
                            </option>
                        </select>
                </div>

                <div class="form-group">
                    <label for="">Клиенты</label>
                    <select name="clientId" class="form-control">
                            @foreach($allClients as $client)
                                <option value="{{ $client->id }}"
                                {{isset($_GET['clientId']) ?  ($_GET['clientId'] == $client->id ? 'selected' : '') : ''}} >
                                {{ $client->name }}
                                </option>
                            @endforeach
                            <option value="" 
                            {{ isset($_GET['clientId']) ? ($_GET['clientId'] == null ? 'selected' : '') : 'selected'}}>
                                Все
                            </option>
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
                    Заказчик
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
                <td>{{ $order->client ? $order->client->name : 'Клиент удален'}}</td>
                <td>
                    <a href="{{route('executor.viewOrder',['id'=>$order->id])}}" class="btn btn-danger">Посмотреть</a>
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