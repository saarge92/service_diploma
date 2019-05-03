@extends('layouts.admin')


@section('content')
<div class="row mt-2">
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>
                    ФИО Клиента
                </th>
            </tr>
            @foreach($contactRecords as $record)
            <tr>
                <td>
                    {{ $record->name }}
                </td>
                <td>
                    <button class="btn btn-danger deleteUser" data-record_id={{$record->id}}>
                        <i class="fas fa-times"></i>
                        Удалить
                    </button>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<div class="row mt-2 text-center">
    <div class="col-md-12">
        {{$contactRecords->appends(request()->input())->links()}}
    </div>
</div>
@endsection


@section('scripts')
<script src="{{URL::asset('admin/js/deleteContact.js')}}"></script>
@endsection