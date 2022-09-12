
<nav class="navbar navbar-expand-lg bg-img fixed-top" style="background-color: #245319;">
  <div class="container-fluid">
        <img src="../img/Logo.png" width="80rem" alt="">
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <div class="d-flex justify-content-between">
            <ul class="navbar-nav">
                <li class="nav-item px-4 py-2 activar1" id="nav1">
                    <a class="nav-link text-white" id="nav_personal" aria-current="page" href="{{route('infoPersonal')}}"><i class="fas fa-user-edit"></i> Personal</a>
                </li>
                <li class="nav-item px-4 py-2 activar2" id="nav2">
                    <a class="nav-link text-white" id="nav_direcciones" href="{{route('infoDirecciones')}}"><i class="fas fa-map-marked-alt"></i> Direcciones</a>
                </li>
                <li class="nav-item px-4 py-2 activar3" id="nav3">
                    <a class="nav-link text-white" id="nav_contactos" href="{{route('infoContactos')}}"><i class="fas fa-address-book"></i> Contactos</a>
                </li>
            </ul>
        </div>
    </div>
  </div>
</nav>