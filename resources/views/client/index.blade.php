@extends('layouts.client') 
@section('title') Новые заявки
@endsection
 
@section('content') {{--
<div class="container"> --}}
    <div class="row">
        <div class="">
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
    {{-- </div> --}}
@endsection