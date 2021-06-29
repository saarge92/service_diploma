@extends('layouts.admin')
@section('title') Команда
@endsection

@section('content')
    <div class="row mt-2 ml-2">
        <a href="/admin/teams/create" class="btn btn-primary"> <i class="fas fa-plus"></i> Добавить члена команды</a>
    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            @foreach ($teams->chunk(3) as $teamChunked)
                <div class="row mt-2">
                    @foreach($teamChunked as $team)
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="about-move">
                                <div class="services-details">
                                    <div class="single-services">
                                        <a class="services-icon" href="#">
                                            <img src="{{  Storage::url($team->photo) }}" class="service-img">
                                        </a>
                                        <h4>{{ $team->name }}</h4>
                                        <div class="text-justify" style="height:8.5em;">
                                            {{ $team->position }}
                                        </div>
                                    </div>
                                    <div class="text-center" style="padding-bottom:1.2rem;">
                                        <a href="{{ route('admin.service.editService', ['id' => $team->id] ) }}" class="btn btn-danger">Редактировать</a>
                                        <button class="btn btn-default service-delete" data-service_id={{$team->id}}>
                                            <i class="fas fa-trash"></i>
                                            Удалить
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- </div> --}}
            @endforeach
        </div>
{{--        <div class="row mt-2 text-center">--}}
{{--            <div class="col-md-12">--}}
{{--                {{$teams->appends(request()->input())->links()}}--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@endsection
