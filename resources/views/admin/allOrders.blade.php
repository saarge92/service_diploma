@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('frontend.services') }}" class="btn btn-success">
                <i class="fas fa-plus"></i>
                Добавить Заявку
            </a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card-header">
                Фильтры заявок
            </div>
            <div class="card-body">
                <form method="GET" action="{{route('admin.all-requests')}}">
                    <div class="form-group">
                        <label for="">Статусы заявок</label>
                        <select name="statusId" id="orderSelect" class="form-control">
                            @foreach ($statuses as $status)
                                <option value="{{$status->id}}" {{isset($_GET['statusId']) ?  ($_GET['statusId'] == $status->id ? 'selected' : '') : ''}}>
                                    {{$status->name}}
                                </option>
                            @endforeach
                            <option value="new" {{ isset($_GET['statusId']) ? ($_GET['statusId'] == 'new' ? 'selected' : '') : ''}}>
                                Новая
                            </option>
                            <option value="" {{ isset($_GET['statusId']) ? ($_GET['statusId'] == null ? 'selected' : '') : 'selected'}}>
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
                                    {{ isset($_GET['clientId']) ? ($_GET['clientId'] == null ||
                                        !in_array($_GET['clientId'],$allClients->pluck('id')->toArray())
                                     ? 'selected' : '') : 'selected'}}>
                                Все
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Исполнители</label>
                        <select name="executorId" class="form-control">
                            @foreach($allExecutors as $executor)
                                <option value="{{ $executor->id }}" {{isset($_GET['executorId']) ?
                            ($_GET['executorId'] == $executor->id ? 'selected' : '') : ''}}>
                                    {{ $executor->name }}
                                </option>
                            @endforeach
                            <option value=""
                                    {{ isset($_GET['executorId']) ? ($_GET['executorId'] == null
                                    ||  !in_array($_GET['executorId'],$allExecutors->pluck('id')->toArray())
                                    ? 'selected' : '') : 'selected'}}>
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
                        Дата создания
                        @if(isset($_GET['orderDate'])) @if($_GET['orderDate']=='asc')
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
                                <?php echo $prevText . '<br/>'; ?> @endforeach
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
                            <a href="{{ route('admin.viewUser',['userId' => $order->client->id]) }}">{{ $order->client->name }}</a>
                        </td>
                        <td>
                            <a href="{{route('admin.viewOrder',['id'=>$order->id])}}"
                               class="btn btn-danger">Посмотреть</a>
                        </td>
                        <td>
                            <button class="btn btn-default deleteRequest" data-request_id={{$order->id}}>
                                <i class="fas fa-times"></i>
                                Удалить
                            </button>
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

@section('scripts')
    <script src="{{ URL::asset('admin/js/allOrders.js') }}"></script>
@endsection