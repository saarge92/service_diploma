<!-- Start Service area -->
<div id="services" class="services-area area-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-headline services-head text-center">
                    <h2>Наши услуги</h2>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="services-contents">
                @foreach ($services->chunk(3) as $chunkedServices) @foreach ($chunkedServices as $service)
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
                        <button data-service_id="{{$service->id}}" data-toggle="modal" data-target="#infoModal" 
                            class="orderService btn btn-danger">Заказать</button>
                    </div>
                </div>
                @endforeach @endforeach
            </div>
        </div>
        <div class="text-center">
        <a href="#" class="btn btn-primary">Все услуги</a>
        </div>
    </div>
</div>
<!-- End Service area -->