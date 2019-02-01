<header>
    <!-- header-area start -->
    <div id="sticker" class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">

                    <!-- Navigation -->
                    <nav class="navbar navbar-default">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".bs-example-navbar-collapse-1"
                                aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            <!-- Brand -->
                            <a class="navbar-brand page-scroll sticky-logo" href="{{route('frontend.home')}}">
                                <h1><span>e</span>Business</h1>
                                <!-- Uncomment below if you prefer to use an image logo -->
                                <!-- <img src="img/logo.png" alt="" title=""> -->
                            </a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse main-menu bs-example-navbar-collapse-1" id="navbar-example">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="active">
                                    <a class="page-scroll" href="{{route('frontend.home').'#home'}}"><i class="fa fa-home"></i>Домой</a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#about"><i class="fa fa-info" aria-hidden="true"></i>О нас</a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#services"><i class="fa fa-money" aria-hidden="true"></i>Услуги</a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#team">Команда</a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="{{route('frontend.getShoppingCart')}}">
                                        <i class="fa fa-shopping-basket"></i>
                                        <span id="count_order">{{!Session::has('cart')||Session::get('cart')->totalQty==0  ? '': Session::get('cart')->totalQty}}
                                        </span>
                                        Корзина
                                    </a>
                                </li>

                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Drop Down<span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href=#>Drop Down 1</a></li>
                                        <li><a href=#>Drop Down 2</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="page-scroll" href="#contact">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <!-- navbar-collapse -->
                    </nav>
                    <!-- END: Navigation -->
                </div>
            </div>
        </div>
    </div>
    <!-- header-area end -->
</header>
<!-- header end -->