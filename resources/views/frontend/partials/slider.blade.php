<!-- Start Slider Area -->
<div id="home" class="slider-area">
    <div class="bend niceties preview-2">
        <div id="ensign-nivoslider" class="slides">
            @foreach ($sliders as $index => $slider)
                <img src="{{Storage::url($slider->path)}}" alt="" title="{{'#slider-direction-'.$index}}"> 
            @endforeach
        </div>
        @foreach ($sliders as $index => $slider)
        <div id="{{'slider-direction-'.$index}}" class="slider-direction slider-one">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="slider-content">
                            <!-- layer 1 -->
                            <div class="layer-1-1 hidden-xs wow slideInDown" data-wow-duration="2s" data-wow-delay=".2s">
                                <h2 class="title1">{{$slider->title}} </h2>
                            </div>
                            <!-- layer 2 -->
                            <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                                <h1 class="title2">{{$slider->content}}</h1>
                            </div>
                            <!-- layer 3 -->
                            <div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                                <a class="ready-btn right-btn page-scroll" href="#services">Заказать усуги</a> {{-- <a class="ready-btn page-scroll"
                                    href="#about">Learn More</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- End Slider Area -->