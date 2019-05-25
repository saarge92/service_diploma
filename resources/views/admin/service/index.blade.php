@extends('layouts.admin')
@section('title') Все услуги
@endsection

@section('content')
<div class="row mt-2 ml-2">
    <a href="#" class="btn btn-primary"> <i class="fas fa-plus"></i> Добавить услугу</a>
</div>
<div class="row mt-2">
    <div class="col-md-12">
        @foreach ($services->chunk(3) as $chunkedServices)
        <div class="row mt-2">
            @foreach($chunkedServices as $service)
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="about-move">
                    <div class="services-details">
                        <div class="single-services">
                            <a class="services-icon" href="#">
                                <img src="{{  Storage::url($service->path) }}" class="service-img">
                            </a>
                            <h4>{{ $service->title }}</h4>
                            <div class="text-justify" style="height:8.5em;">
                                {{ $service->content }}
                            </div>
                        </div>
                        <div class="text-center" style="padding-bottom:1.2rem;">
                            <a href="{{ route('admin.service.editService', ['id' => $service->id] ) }}" class="btn btn-danger">Редактировать</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{-- </div> --}}
        @endforeach
    </div>
    <div class="row mt-2 text-center">
        <div class="col-md-12">
            {{$services->appends(request()->input())->links()}}
        </div>
    </div>
</div>
@endsection