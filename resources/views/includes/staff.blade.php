<nav id="sidebar"> 
    <div class="sidebar-content"> 
        <div class="content-header content-header-fullrow px-15"> 
            <div class="content-header-section sidebar-mini-visible-b"> 
                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                    <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                </span> 
            </div> 
            <div class="content-header-section text-center align-parent sidebar-mini-hidden"> 
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times text-danger"></i>
                </button> 
                <div class="content-header-item">
                    <a class="link-effect font-w700" href="#">
                        <i class="si si-fire text-primary"></i>
                        <span class="font-size-xl text-dual-primary-dark">Learn</span><span class="font-size-xl text-primary"> On Go</span>
                    </a>
                </div> 
            </div> 
        </div>  
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li class="open">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Notes</span></a>
                    <ul>
                        <li>
                            <a href="/staff/notes">View Notes</a>
                        </li>
                        <li>
                            <a href="/staff/notes/create">Add Notes</a>
                        </li> 
                    </ul> 
                </li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Videos</span></a>
                    <ul>
                        <li>
                            <a href="/staff/videos">View Videos</a>
                        </li>
                        <li>
                            <a href="/staff/videos/create">Add Videos</a>
                        </li> 
                    </ul> 
                </li>  
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Assignment</span></a>
                    <ul>
                        <li>
                            <a href="/staff/assignment">View Assignment</a>
                        </li>
                        <li>
                            <a href="/staff/assignment/create">Add Assignment</a>
                        </li> 
                    </ul> 
                </li>  
            </ul>
        </div> 
    </div> 
</nav> 
<header id="page-header" style="background-color: #343a40;"> 
    <div class="content-header"> 
        <div class="content-header-section"> 
            <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-navicon"></i>
            </button> 
            <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="header_search_on">
                <i class="fa fa-search"></i>
            </button>  
        </div>  
        <div class="content-header-section"> 
            <ul class="navbar-nav ml-auto d-flex flex-row" > 
                @guest
                    <li class="nav-item mr-2">
                        <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="text-white nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" >
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>  
        </div> 
    </div> 

    <!-- Header Search -->
    <div id="page-header-search" class="overlay-header">
        <div class="content-header content-header-fullrow">
            <form action="be_pages_generic_search.html" method="post">
                <div class="input-group">
                    <div class="input-group-prepend"> 
                        <button type="button" class="btn btn-secondary" data-toggle="layout" data-action="header_search_off">
                            <i class="fa fa-times"></i>
                        </button> 
                    </div>
                    <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div> 
    <div id="page-header-loader" class="overlay-header bg-primary">
        <div class="content-header content-header-fullrow text-center">
            <div class="content-header-item">
                <i class="fa fa-sun-o fa-spin text-white"></i>
            </div>
        </div>
    </div> 
</header>