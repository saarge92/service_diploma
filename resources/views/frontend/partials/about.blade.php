<!-- Start About area -->
<div id="about" class="about-area area-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-headline text-center">
                    <h2>О нас</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- single-well start-->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="well-left">
                    <div class="single-well">
                        <a href="#">
                              <img src="{{Storage::url($about ? $about->path : '')}}" alt="">
                            </a>
                    </div>
                </div>
            </div>
            <!-- single-well end-->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="well-middle">
                    <div class="single-well">
                        <a href="#">
                            <h4 class="sec-head">{{$about ? $about->title : ''}}</h4>
                        </a>
                        <p>
                            {{$about ? $about->content : ''}}
                        </p>
                        <ul>
                            @foreach ($aboutFeatures as $item)
                            <li>
                                <i class="fa fa-check"></i> {{$item}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End col-->
        </div>
    </div>
</div>
<!-- End About area -->