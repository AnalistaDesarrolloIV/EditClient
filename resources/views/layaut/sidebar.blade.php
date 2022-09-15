
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
<script>
    $("#nav_personal").click(function () {
        
        $(this).addClass("disabled");
        $("#nav_direcciones").addClass("disabled");
        $("#nav_contactos").addClass("disabled");
        
        $("#content").html(
        `
            <div class="col-12">
                <div class="row">
                    <div class="col-12 text-center ">
                        <h1 class=""><b>INFORMACIÓN PERSONAL.</b> </h1>
                    </div>
                </div>

                <form action="npersonaledit" method="post" enctype="multipart/form-data">
                    <div class="row my-5">
                        <div class="col-12 my-5">
                            <div class="text-center">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p>Cargando formulario..</p>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-end my-2">
                        <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                            <button type="button" class="btn btn-dark text-white" disabled>Editar y siguiente <i class="fas fa-angle-double-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        `
        ) ;
    });

    $("#nav_direcciones").click(function () {
        
        $("#nav_personal").addClass("disabled");
        $(this).addClass("disabled");
        $("#nav_contactos").addClass("disabled");
        
        $("#content").html(
        `
            <div class="col-12">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class=""><b>DIRECCIONES.</b> </h1>
                    </div>
                </div>

                <form action="npersonaledit" method="post" enctype="multipart/form-data">
                    <div class="row my-5">
                        <div class="col-12 my-5">
                            <div class="text-center">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p>Cargando Direcciones..</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row d-flex justify-content-between mb-5">
                            <div class="col-12 col-md-2 pb-2 pb-md-0 d-grid gap-2">
                                <button type="button" class="btn btn-outline-dark " disabled><i class="fas fa-angle-double-left"></i> Atrás</button>
                            </div>
                            <div class="col-12 col-md-2 pb-2 pb-md-0 d-grid gap-2">
                                <button type="button" class="btn btn-dark disabled" disabled>Siguiente <i class="fas fa-angle-double-right"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        `
        ) ;
    });
    
    $("#nav_contactos").click(function () {
        
        $("#nav_personal").addClass("disabled");
        $("#nav_direcciones").addClass("disabled");
        $(this).addClass("disabled");
        
        $("#content").html(
        `
            <div class="col-12">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class=""><b>CONTACTOS.</b> </h1>
                    </div>
                </div>

                <form action="npersonaledit" method="post" enctype="multipart/form-data">
                    <div class="row my-5">
                        <div class="col-12 my-5">
                            <div class="text-center">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p>Cargando Cotactos..</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="row d-flex justify-content-between mb-5">
                            <div class="col-12 col-md-2 pb-2 pb-md-0 d-grid gap-2">
                                <button type="button" class="btn btn-outline-dark " disabled><i class="fas fa-angle-double-left"></i> Atrás</button>
                            </div>
                            <!-- Button trigger modal -->
                            <div class="col-12 col-md-2 pb-2 pb-md-0 d-grid gap-2" >
                                <button class="btn btn-dark disabled">Finalizar <i class="fas fa-angle-double-right"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        `
        ) ;
    });
</script>