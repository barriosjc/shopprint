<header class="bg-dark navbar-sticky">
    <div class="navbar navbar-expand-lg navbar-dark">
        <div class="container"><a class="navbar-brand d-none d-sm-block me-4 order-lg-1" href="{{ route('home') }}">
            <img src={{ asset('template/img/logo-top-imprint-signs.png') }} width="140" alt="Imprint Signs"></a>
                    <a class="navbar-brand d-sm-none me-2 order-lg-1" href="{{ route('home') }}" style="min-width: 4.625rem;">
            <img src={{ asset('template/img/logo-top-imprint-signs.png') }} width="140" alt="Imprint-signs"></a>
            <div class="navbar-toolbar d-flex align-items-center order-lg-3">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse"><span class="navbar-toggler-icon"></span></button>
				<!-- Profile dropdown-->
				
                <div class="navbar-tool dropdown ms-3"> <a class="navbar-tool ms-1 me-n1" href="#signin-modal" data-bs-toggle="modal"><span
                            class="navbar-tool-tooltip">{{ Auth()->user()->email }}</span>
                        <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-user"></i></div>
                    </a>
                        <div class="dropdown-menu"  aria-labelledby="navbarDropdownMenuLink">                            
                            <a href="{{ route('front.profile') }} " class="dropdown-item">Profile info</a>
                            <div class="dropdown-divider"></div>
                            {{-- <a href="#" class="dropdown-item">Log Out</a> --}}
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                            <i data-feather="log-out"></i>                                                        
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                                            <!-- Cart dropdown-->
                </div>
				
                <div class="navbar-tool dropdown ms-3"><a class="navbar-tool-icon-box bg-secondary dropdown-toggle"
                        href="{{ route('cart.index') }}"><span class="navbar-tool-label">{{Cart::getContent()->count()}}</span><i class="navbar-tool-icon ci-cart"></i></a>
                        
                                            <!-- Cart dropdown-->
                </div>
            </div>

            <!-- Dropdown example 2 -->

            <div class="collapse navbar-collapse me-auto order-lg-2" id="navbarCollapse">
                <!-- Search-->
                <div class="input-group d-lg-none my-3"><i
                        class="ci-search position-absolute top-50 start-0 translate-middle-y text-muted fs-base ms-3"></i>
                    <input class="form-control rounded-start" type="text" placeholder="Search for products">
                </div>
                <!-- Primary menu-->
                <ul class="navbar-nav">
                    <li class="nav-item text-center"><a class="nav-link" href="{{ route('productos.list', 1) }}">
                            <div style=" display: flex; justify-content: center; padding-bottom: 5px;"><img
                                    src={{ asset('template/img/icons/banner.png') }} alt="" />
                            </div>Banner
                            @if(isset($descuentos[1]))
                            <span class="position-absolute top-25 start-80 translate-middle badge rounded-pill bg-danger">
                                {{$descuentos[1]}}% OFF
                                <span class="visually-hidden">unread messages</span>
                            </span>
                            @endif
                        </a>

                    </li>
                    <li class="nav-item text-center"><a class="nav-link" href="{{ route('productos.list', 3) }}">
                            <div style=" display: flex; justify-content: center; padding-bottom: 5px;"><img
                                    src={{ asset('template/img/icons/rigid.png') }} alt="" />
                            </div>Rigid
                            @if(isset($descuentos[3]))
                            <span class="position-absolute top-25 start-80 translate-middle badge rounded-pill bg-danger">
                                {{$descuentos[3]}}% OFF
                                <span class="visually-hidden">unread messages</span>
                            </span>
                            @endif
                        </a>

                    </li>
                    <li class="nav-item text-center">
                        <a class="nav-link" href="{{ route('productos.list', 4) }}">
                            <div style=" display: flex; justify-content: center; padding-bottom: 5px;"><img
                                    src={{ asset('template/img/icons/adhesive.png') }} alt="" />
                            </div>Adhesive
                            @if(isset($descuentos[4]))
                            <span class="position-absolute top-25 start-80 translate-middle badge rounded-pill bg-danger">
                                {{$descuentos[4]}}% OFF
                                <span class="visually-hidden">unread messages</span>
                            </span>
                            @endif
                       </a>

                    </li>
                    <li class="nav-item text-center">
                        <a class="nav-link  position-relative" href="{{ route('productos.list', 2) }}">
                            <div style=" display: flex; justify-content: center; padding-bottom: 5px;"><img
                                    src={{ asset('template/img/icons/magnets.png') }} alt="" />
                            </div>Magnets
                            @if(isset($descuentos[2]))
                            <span class="position-absolute top-25 start-80 translate-middle badge rounded-pill bg-danger">
                                {{$descuentos[2]}}% OFF
                                <span class="visually-hidden">unread messages</span>
                            </span>
                            @endif
                        </a>

                    </li>
                    <li class="nav-item text-center"><a class="nav-link" href="{{ route('productos.list', 5) }}">
                            <div style=" display: flex; justify-content: center; padding-bottom: 5px;"><img
                                    src={{ asset('template/img/icons/banner-stand.png') }} alt="" />
                            </div>Banner Stand
                            @if(isset($descuentos[5]))
                            <span class="position-absolute top-25 start-80 translate-middle badge rounded-pill bg-danger">
                                {{$descuentos[5]}}% OFF
                                <span class="visually-hidden">unread messages</span>
                            </span>
                            @endif
                        </a>

                    </li>
                    <li class="nav-item text-center"><a class="nav-link" href="{{ route('productos.list', 6) }}">
                            <div style=" display: flex; justify-content: center; padding-bottom: 5px;"><img
                                    src={{ asset('template/img/icons/clothing.png') }} alt="" />
                            </div>Clothing
                            @if(isset($descuentos[6]))
                            <span class="position-absolute top-25 start-80 translate-middle badge rounded-pill bg-danger">
                                {{$descuentos[6]}}% OFF
                                <span class="visually-hidden">unread messages</span>
                            </span>
                            @endif
                        </a>

                    </li>
                    <li class="nav-item text-center"><a class="nav-link" href="{{ route('productos.list', 7) }}">
                            <div style=" display: flex; justify-content: center; padding-bottom: 5px;"><img
                                    src={{ asset('template/img/icons/sticker.png') }} alt="" />
                            </div>Stickers/Labels
                            @if(isset($descuentos[7]))
                            <span class="position-absolute top-25 start-80 translate-middle badge rounded-pill bg-danger">
                                {{$descuentos[7]}}% OFF
                                <span class="visually-hidden">unread messages</span>
                            </span>
                            @endif
                        </a>

                    </li>
                    <li class="nav-item text-center"><a class="nav-link" href="{{ route('productos.list', 8) }}">
                            <div style=" display: flex; justify-content: center; padding-bottom: 5px;"><img
                                    src={{ asset('template/img/icons/misc.png') }} alt="" />
                            </div>Misc
                            @if(isset($descuentos[8]))
                            <span class="position-absolute top-25 start-80 translate-middle badge rounded-pill bg-danger">
                                {{$descuentos[8]}}% OFF
                                <span class="visually-hidden">unread messages</span>
                            </span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


</header>
