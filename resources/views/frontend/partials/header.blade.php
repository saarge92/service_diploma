<header>
    <!-- header-area start -->
    <div id="sticker" class="header-area">

        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{Session::get('success')}}</strong>
        </div>
        @endif

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
                                    <a class="page-scroll" href="{{route('frontend.home').'#about'}}"><i class="fa fa-info" aria-hidden="true"></i>О нас</a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="{{route('frontend.home').'#services'}}"><i class="fa fa-money" aria-hidden="true"></i>Услуги</a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="{{route('frontend.home').'#team'}}"> <i class="fa fa-users"></i> Команда</a>
                                </li>
                                <li>
                                    <a class="page-scroll" href="{{route('frontend.getShoppingCart')}}">
                                        <i class="fa fa-shopping-basket"></i>
                                        <span id="count_order">{{!Session::has('cart')||Session::get('cart')->totalQty==0  ? '': Session::get('cart')->totalQty}}
                                        </span>
                                        Корзина
                                    </a>
                                </li>
                                @if(Auth::check())
                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Привет, {{Auth::user()->name}}
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href=#>Профиль</a></li>
                                        <li><a href=#>Заявки</a></li>
                                        <li> <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();">
                                             {{ __('Выйти') }}
                                         </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                @else
                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                       <i class="fa fa-user"></i> Пользователь
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{route('register')}}"> <i class="fa fa-user-plus"></i> Регистрация</a></li>
                                        <li><a href="{{route('login')}}"> <i class="fa fa-sign-in"></i> Войти</a></li>
                                    </ul>
                                </li>
                                @endif
                                <li>
                                    <a class="page-scroll" href="#contact"> <i class="fa fa-phone"></i> Контакты</a>
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