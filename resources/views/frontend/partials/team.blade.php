<!-- Start team Area -->
<div id="team" class="our-team-area area-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-headline text-center">
                    <h2>Наша команда</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="team-top">
                @foreach ($teams as $item)
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="single-team-member">
                        <div class="team-img">
                            <a href="#">
                                <img src="{{Storage::url($item->photo)}}" alt="">
                                        </a>
                            <div class="team-social-icon text-center">
                                <ul>
                                    @if($item->vk_url)
                                    <li>
                                        <a href="{{$item->vk_url}}" target="_blank">
                                                        <i class="fa fa-vk"></i>
                                                    </a>
                                    </li>
                                    @endif @if($item->instagram_url)
                                    <li>
                                        <a href="{{$item->instagram_url}}" target="_blank">
                                                        <i class="fa fa-instagram"></i>
                                                    </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="team-content text-center">
                            <h4>{{$item->name}}</h4>
                            <p>{{$item->position}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- End Team Area -->