@extends('layouts.frontend') 
@section('title') Все услуги
@endsection
 
@section('content')
<div class="container" id="servicesPage">
    @foreach ($services->chunk(3) as $chunkedServices)
    <div class="row text-center">
        <div class="services-contents">
            @foreach ($chunkedServices as $service)
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="about-move">
                    <div class="services-details">
                        <div class="single-services">
                            <a class="services-icon" href="#">
                                    <img src="{{Storage::url($service->path)}}" class="service-img">
                                    </a>
                            <h4>{{$service->title}}</h4>
                            <p>
                                {{$service->content}}
                            </p>
                        </div>
                    </div>
                    <!-- end about-details -->
                </div>
                <div class="text-center">
                    <button data-service_id="{{$service->id}}" data-toggle="modal" data-target="#infoModal" class="orderService btn btn-danger">Заказать</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
    <div class="row mt-2 text-center">
        <div class="col-md-12">
            {{$services->appends(request()->input())->links()}}
        </div>
    </div>
</div>
@endsection
 
@section('scripts')
<script src="{{URL::asset('frontend/js/cartMain.js')}}"></script>
@endsection