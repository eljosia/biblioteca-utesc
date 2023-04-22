<nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 py-lg-0 navbar-dark menusize" style="background-color: #3BBBA8;" id="navbarVertical">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand py-lg-5 mb-lg-5 px-lg-6 me-0" href="#">
            <img src="{{image('logo.png')}}" class="d-none d-lg-inline-block"> Biblioteca
        </a>
        <!-- User menu (mobile) -->
        <div class="navbar-user d-lg-none">
            <!-- Dropdown -->
            <div class="dropdown">
                <!-- Toggle -->
                <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar rounded-circle text-white">
                        <img src="{{image('logo.png')}}" alt="...">
                    </div>
                </a>
            </div>
        </div>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="*">
                        <i class="fa-solid fa-gauge"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#collapseNav" role="button" aria-expanded="false" aria-controls="collapseNav">
                        <i class="fa-solid fa-book-bookmark"></i> Libros
                    </a>
                    <div class="collapse show" id="collapseNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link ps-18 ps-lg-10" href="{{route('book.index')}}">
                                    <i class="fa-solid fa-book"></i> Todos los Libros
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ps-18 ps-lg-10" href="*">
                                    <i class="fa-solid fa-book-open"></i> Nuevo Libro
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ps-18 ps-lg-10" href="*">
                                    <i class="fa-solid fa-book-open-reader"></i> Reportes
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa-solid fa-people-carry-box"></i> Prestamos
                    </a>
                </li>
            </ul>
            <!-- Push content down -->
            <div class="mt-auto"></div>
            <!-- User (md) -->
            <ul class="navbar-nav mb-5">
                <li class="nav-item">
                    <a class="nav-link" href="*">
                        <i class="fa-solid fa-user-large"></i> Cuenta
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit(); " role="button">
                            <i class="fa-solid fa-right-from-bracket"></i> Salir
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>