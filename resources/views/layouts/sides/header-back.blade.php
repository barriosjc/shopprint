<header class="bg-dark navbar-sticky">
    <div class="navbar navbar-expand-lg navbar-dark">
        <div class="container"><a class="navbar-brand d-none d-sm-block me-4 order-lg-1" href="{{ route('home') }}">
                <img src={{ asset('template/img/logo-top-imprint-signs.png') }} width="140" alt="Imprint Signs"></a>
            <a class="navbar-brand d-sm-none me-2 order-lg-1" href="{{ route('home') }}" style="min-width: 4.625rem;">
                <img src={{ asset('template/img/logo-top-imprint-signs.png') }} width="140" alt="Imprint-signs"></a>
            <div class="navbar-toolbar d-flex align-items-center order-lg-3">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse"><span class="navbar-toggler-icon"></span>
                    <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-user"></i></div>
                </button>
                {{-- <a class="navbar-tool ms-1 me-n1" href="#signin-modal" data-bs-toggle="modal"><span
                        class="navbar-tool-tooltip">{{ Auth()->user()->email }}</span>
                    <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-user"></i></div>
                </a> --}}
                <div class="navbar-tool dropdown ms-3">
                    {{-- <a class="navbar-tool-icon-box bg-secondary dropdown-toggle"
                        href="#"><span class="navbar-tool-label">{{ Cart::getContent()->count() }}</span><i
                            class="navbar-tool-icon ci-cart"></i></a> --}}
                    <a class="navbar-tool ms-1 me-n1" href="#signin-modal" data-bs-toggle="modal"><span
                            class="navbar-tool-tooltip">{{ Auth()->user()->email }}</span>
                        <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-user"></i></div>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                        <div class="dropdown-divider"></div>
                        {{-- <a href="#" class="dropdown-item">Log Out</a> --}}
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
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
            </div>

            <!-- Dropdown example 2 -->
            <div class="navbar navbar-expand-lg navbar-dark">
                <div class="container">
                    <div class="collapse navbar-collapse me-auto order-lg-2" id="navbarCollapse">
                        <!-- Primary menu-->
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">Clients</a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="{{ route('clientes.habilitar') }}">Habilitar
                                            Registros</a></li>
                                    <li><a class="dropdown-item" href="{{ route('clientes.index') }}">ABM clients</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">Products</a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="{{ route('productos.index', 0) }}">Productos</a>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                    {{-- <li><a class="dropdown-item" href="{{ route('categorias.index') }}">Categories</a></li>
                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown">Aditional Atributes</a>
                                        <ul class="dropdown-menu dropdown-menu-dark">
                                            <li><a class="dropdown-item" href="{{ route('ProductosAdicionalDef.index') }}">Types Atributes</a></li>
                                            <li><a class="dropdown-item" href="{{ route('ProductosAdicionalDefSelect.index') }}">List values</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('restricciones.index') }}">Restricciones</a></li>
                                    <li><a class="dropdown-item" href="{{ route('notas.index') }}">Notas</a></li>
                                    <li class="dropdown-divider"></li>
                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown">Modificadores</a>
                                        <ul class="dropdown-menu dropdown-menu-dark">
                                            <li><a class="dropdown-item" href="{{ route('tipos.index') }}">Tipos</a></li>
                                            <li><a class="dropdown-item" href="{{ route('opciones.index') }}">Opciones</a></li>
                                        </ul>
                                    </li> --}}
                                </ul>
                            </li>
                            {{-- <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown" data-bs-auto-close="outside">Reports</a>

                            </li> --}}
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown" data-bs-auto-close="outside">Security</a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="{{ route('usuario.index') }}">Users</a></li>
                                    {{-- <li class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('clientes.habilitar') }}">Permisos</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('clientes.habilitar') }}">Roles</a>
                                    </li> --}}
                                </ul>
                            </li>
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown" data-bs-auto-close="outside">Orders</a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="{{ route('orders.list', 'all') }}">All</a></li>
                                    <li class="dropdown-divider"></li>
                                    {{-- <li><a class="dropdown-item" href="{{ route('orders.list','admin') }}">Administration</a></li>
                                    <li><a class="dropdown-item" href="{{ route('orders.list', 'prod') }}">Production</a></li>
                                    <li><a class="dropdown-item" href="{{ route('orders.list', 'shipp') }}">Shipping</a></li> --}}
                                </ul>
                            </li>
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">Utilities</a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="{{ route('parametros.index') }}">Parameters</a>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('descuentos.index') }}">ABM
                                            Descuentos</a></li>
                                </ul>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


</header>
