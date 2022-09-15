@extends('Pages.inicio.index')

@section('tittle', 'Direcciones')

@section('contenido')
    <div class="toast align-items-center text-white bg-dark border-0 fixed-bottom p-2 my-2 ml-2" id="alert" role="alert" aria-live="assertive" aria-atomic="true"  data-bs-delay="10000">
        <div class="d-flex">
            <div class="toast-body">
                    <strong><i class="fas fa-info-circle text-info"></i> </strong>Debe ingresar por lo menos una dirección por cada tipo (Envío y Facturación) para poder continuar.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div class="relative flex items-top justify-center min-h-screen  sm:items-center sm:pt-0">
        <div class="container-fluid mt-5">    
            <div class="row justify-center align-items-center ">
                <div class="col-12">
                    <div class="row op rounded p-4 pb-2 mt-3"  id="content">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h1 class=""><b>DIRECCIONES.</b> </h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 pb-4">
                                    <div class="d-grid gap-2">
                                        <a href="{{route('createDireccion')}}" class="btn btn-dark" id="create_direccion"><i class="fas fa-plus-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Crear nueva dirección"></i> Agregar dirección</a>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-center">
                                    <h3><strong>Direcciones de envío.</strong></h3>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-dark" id="dt">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Acciones</th>
                                                    <th>#ID</th>
                                                    <th>Nombre de sede/establecimieto/granja/sucursal</th>
                                                    <th>Dirección fisica</th>
                                                    <th>Departamento</th>
                                                    <th>Ciudad</th>
                                                    <th>Barrio/Vereda/Corregimiento</th>
                                                    <th>Codigo postal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($direccion as $key => $val)
                                                    @if($direccion[$key]['Tipo_Direccion'] == "S")
                                                        <tr>
                                                            <td class="text-center edit_d"><a href="/ndiredit/{{$direccion[$key]['LineNum']}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar dirección N°{{$direccion[$key]['LineNum']}}"><i class="fas fa-pen"></i></a></td>
                                                            <td>{{$direccion[$key]['LineNum']}}</td>
                                                            <td>{{$direccion[$key]['Nombre_Direccion']}}</td>
                                                            <td>{{$direccion[$key]['Direccion_fisica']}}</td>
                                                            <td>{{$direccion[$key]['Departamento']}}</td>
                                                            <td>{{$direccion[$key]['Ciudad']}}</td>
                                                            <td>{{$direccion[$key]['Barrio_Vereda_Corregimiento']}}</td>
                                                            <td>{{$direccion[$key]['Codigo_Postal']}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-5">
                                <div class="col-12 text-center">
                                    <h3><strong>Direcciones de facturación.</strong></h3>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-dark" id="dt_2">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Acciones</th>
                                                    <th>#ID</th>
                                                    <th>Nombre de sede/establecimieto/granja/sucursal.</th>
                                                    <th>Dirección fisica</th>
                                                    <th>Departamento</th>
                                                    <th>Ciudad</th>
                                                    <th>Barrio/Vereda/Corregimiento</th>
                                                    <th>Codigo postal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($direccion as $key => $val)
                                                    @if($direccion[$key]['Tipo_Direccion'] == "B")
                                                        <tr>
                                                            <td class="text-center edit_d"><a href="/ndiredit/{{$direccion[$key]['LineNum']}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar dirección N°{{$direccion[$key]['LineNum']}}"><i class="fas fa-pen"></i></a></td>
                                                            <td>{{$direccion[$key]['LineNum']}}</td>
                                                            <td>{{$direccion[$key]['Nombre_Direccion']}}</td>
                                                            <td>{{$direccion[$key]['Direccion_fisica']}}</td>
                                                            <td>{{$direccion[$key]['Departamento']}}</td>
                                                            <td>{{$direccion[$key]['Ciudad']}}</td>
                                                            <td>{{$direccion[$key]['Barrio_Vereda_Corregimiento']}}</td>
                                                            <td>{{$direccion[$key]['Codigo_Postal']}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row d-flex justify-content-between mb-5">
                                <div class="col-12 col-md-2 pb-2 pb-md-0 d-grid gap-2">
                                    <a href="{{route('infoPersonal')}}" class="btn btn-outline-dark " id="atras"><i class="fas fa-angle-double-left"></i> Atrás</a>
                                </div>
                                <div class="col-12 col-md-2 pb-2 pb-md-0 d-grid gap-2">
                                    <a href="{{route('infoContactos')}}" id="btn_s" class="btn btn-dark disabled">Siguiente <i class="fas fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
@endsection

@section('css')
    <style>
        
        .activar2{
            border-bottom: white solid 2px;
        }
    </style>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#alert').toast('show');
        });

        $('#nav2').val();

        let nombre = [];
        $("#dt").find("tr").each(function (idx, row) {
            if (idx > 0) {
                nombre[idx] = $("td:eq(2)", row).text();
            }
        });
        
        let nombre2 = [];
        $("#dt_2").find("tr").each(function (idx2, row2) {
            if (idx2 > 0) {
                nombre2[idx2] = $("td:eq(2)", row2).text();
            }
        });
        
            // $("#nav_contactos").addClass('disabled');

        if (nombre.length > 1 && nombre2.length >1) {
            $("#btn_s").removeClass('disabled');
            $("#nav_contactos").removeClass('disabled');
            
            $("#btn_s").click(function () {
                // $("#form_login").submit();
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
        }
        
        $("#atras").click(function () {
            // $("#form_login").submit();
            $(this).addClass("disabled");
            
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
        
        $(".edit_d").click(function () {
            // $("#form_login").submit();
            $(this).addClass("disabled");
            
            $("#content").html(`
                <div class="col">
                    <div class="row">
                        <div class="col-12 text-center pb-3">
                            <h1 class=""><b>EDITAR DIRECCIÓN.</b> </h1>
                        </div>
                    </div>
                    <form action="{{route('storeDireccion')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 my-5">
                                <div class="text-center">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p>Cargando formulario..</p>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-end mb-4">
                            <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                <button type="button" class="btn btn-dark text-white" disabled>Editar</button>
                            </div>
                            <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                <button type="button" class="btn btn-outline-dark" disabled>Volver</a>
                            </div>
                        </div>
                    </form>
                </div>
            `);
        });
    
        $("#create_direccion").click(function () {
            // $("#form_login").submit();
            $(this).addClass("disabled");
            
            $("#content").html(
            `
                <div class="col">
                    <div class="row">
                        <div class="col-12 text-center pb-3">
                            <h1 class=""><b>CREAR DIRECCIÓN.</b> </h1>
                        </div>
                    </div>
                    <form action="{{route('storeDireccion')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 my-5">
                                <div class="text-center">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p>Cargando formulario..</p>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-end mb-4">
                            <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                <button type="button" class="btn btn-dark text-white" disabled>Crear</button>
                            </div>
                            <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                <button type="button" class="btn btn-outline-dark" disabled>Volver</a>
                            </div>
                        </div>
                    </form>
                </div>
            `
            ) ;
        });

    </script>
@endsection