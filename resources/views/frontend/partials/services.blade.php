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
                </div>
                @endforeach @endforeach {{--
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="about-move">
                        <div class="services-details">
                            <div class="single-services">
                                <a class="services-icon" href="#">
                                        <i class="fa fa-camera-retro"></i>
                                    </a>
                                <h4>Creative Designer</h4>
                                <p>
                                    will have to make sure the prototype looks finished by inserting text or photo.make sure the prototype looks finished by.
                                </p>
                            </div>
                        </div>
                        <!-- end about-details -->
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <!-- end col-md-4 -->
                    <div class=" about-move">
                        <div class="services-details">
                            <div class="single-services">
                                <a class="services-icon" href="#">
                                        <i class="fa fa-wordpress"></i>
                                    </a>
                                <h4>Wordpress Developer</h4>
                                <p>
                                    will have to make sure the prototype looks finished by inserting text or photo.make sure the prototype looks finished by.
                                </p>
                            </div>
                        </div>
                        <!-- end about-details -->
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <!-- end col-md-4 -->
                    <div class=" about-move">
                        <div class="services-details">
                            <div class="single-services">
                                <a class="services-icon" href="#">
                                        <i class="fa fa-camera-retro"></i>
                                    </a>
                                <h4>Social Marketer </h4>
                                <p>
                                    will have to make sure the prototype looks finished by inserting text or photo.make sure the prototype looks finished by.
                                </p>
                            </div>
                        </div>
                        <!-- end about-details -->
                    </div>
                </div> 
                    <!-- end col-md-4 -->
                    <div class=" about-move">
                        <div class="services-details">
                            <div class="single-services">
                                <a class="services-icon" href="#">
                                        <i class="fa fa-bar-chart"></i>
                                    </a>
                                <h4>Seo Expart</h4>
                                <p>
                                    will have to make sure the prototype looks finished by inserting text or photo.make sure the prototype looks finished by.
                                </p>
                            </div>
                        </div>
                        <!-- end about-details -->
                    </div>
                </div>
                <!-- End Left services -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <!-- end col-md-4 -->
                    <div class=" about-move">
                        <div class="services-details">
                            <div class="single-services">
                                <a class="services-icon" href="#">
                                        <i class="fa fa-ticket"></i>
                                    </a>
                                <h4>24/7 Support</h4>
                                <p>
                                    will have to make sure the prototype looks finished by inserting text or photo.make sure the prototype looks finished by.
                                </p>
                            </div>
                        </div>
                        <!-- end about-details -->
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
<!-- End Service area -->