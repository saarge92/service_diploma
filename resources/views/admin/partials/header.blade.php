<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <span class="navbar-brand mr-1">Bar House</span><i class="fas fa-bars"></i>
    </button>
    <ul class="navbar-nav ml-auto mr-md-0">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Админ<i class="fas fa-user-circle fa-fw"></i>
            </a>
            @if(Auth::check())
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Привет {{Auth::user()->name}}</a>
                <div class="dropdown-divider"></div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Выйти</a>
            </div>
            @endif
        </li>
    </ul>
</nav>
