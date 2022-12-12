@extends('Pages.inicio.index')
@section('tittle', 'Contactos')

@section('contenido')

    <div class="toast align-items-center text-white bg-dark border-0 fixed-bottom p-2 my-2 ml-2" id="alert" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="10000">
        <div class="d-flex">
            <div class="toast-body">
                    <strong><i class="fas fa-info-circle text-info"></i> </strong>Debe ingresar por lo menos un contacto por cada tipo (Contador, Tesorero, Comercial y Logistico ) para poder finalizar.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Aceptación tratamiento de datos.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="Final">
                    <form action="{{route('email')}}" method="post" id="form_fin">
                        @csrf
                        <div class="row px-3">
                            <div class="col-12" id="cont_email">
                            </div>
                            <div id="message_email">

                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="si" name="aceptacion" id="acept" onclick="check()">
                                    <label class="form-check-label" for="acept">
                                    Acepta <a class="trat_date" target="_blank" href="http://www.ivanagro.com/politicas-de-tratamiento-de-informacion/">tratamiento de datos</a>. 
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" id="finalizar">Finalizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="relative flex items-top justify-center min-h-screen  sm:items-center py-4 sm:pt-0">
        <div class="container-fluid mt-5">    
            <div class="row justify-center align-items-center ">
                <div class="col-12">
                    <div class="row op rounded p-4 pb-2"  id="content">
                        <div class="col">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h1 class=""><b>CONTACTOS.</b> </h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 pb-4">
                                    <div class="d-grid gap-2">
                                        <a href="{{route('createContacto')}}"class="btn btn-dark" id="Create_c" ><i class="fas fa-plus-circle"></i> Agregar contacto</a>
                                    </div>
                                </div>
                            </div>
                            <form action="" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table table-bordered border-dark" id="dt">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Acciones</th>
                                                        <th>Tipo de contacto</th>
                                                        <th>Nombre de contacto</th>
                                                        <th>Correo</th>
                                                        <th>Celular de contacto</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($contact as $key => $val)
                                                    <tr>
                                                        <td class="text-center"><a class=" edit_c" href="/ncontedit/{{$contact[$key]['Name']}}"><i class="fas fa-pen"></i></a></td>
                                                        <td>{{$contact[$key]['Name']}}</td>
                                                        <td>{{$contact[$key]['FirstName']." ". $contact[$key]['MiddleName']." ". $contact[$key]['LastName']}}</td>
                                                        <td>{{$contact[$key]['E_Mail']}}</td>
                                                        <td>
                                                                {{$contact[$key]['MobilePhone']}}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                                        
                                <div class="row d-flex justify-content-end mb-5">
                                    <!-- <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                        <button type="submit" class="btn btn-dark text-white">Editar</button>
                                    </div>
                                    <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                        <a href="{{ route('info.index')}}" class="btn btn-outline-dark">Volver</a>
                                    </div> -->
                                    
                                </div>
                            </form>
                        </div>
                        
                        
                        <div class="col-12 mt-2">
                            <div class="row d-flex justify-content-between mb-5">
                                <div class="col-12 col-md-2 pb-2 pb-md-0 d-grid gap-2">
                                    <a href="{{route('infoDirecciones')}}" class="btn btn-outline-dark " id="atras"><i class="fas fa-angle-double-left"></i> Atrás</a>
                                </div>
                                <!-- Button trigger modal -->
                                <div class="col-12 col-md-2 pb-2 pb-md-0 d-grid gap-2" >
                                    <button class="btn btn-dark disabled" id="btn_Fin" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Finalizar <i class="fas fa-angle-double-right"></i></button>
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

        .activar3{
            border-bottom: white solid 2px;
        }
        .trat_date{
            color: #055dca;
            
        }
        .trat_date:hover {
            color: #106ddf;
            text-decoration-line: underline; 
        }
    </style>
@endsection

@section('script')
    <script>
        
        $(document).ready(function() {
            $('#alert').toast('show');
        });

        let nombre = [];
        $("#dt").find("tr").each(function (idx, row) {
            if (idx > 0) {
                nombre[idx] = $("td:eq(2)", row).text();
            }
        });

        if (nombre.length > 1) {
            $("#btn_Fin").removeClass('disabled');
            
        }
        $("#atras").click(function () {
            // $("#form_login").submit();
            $(this).addClass("disabled");
            
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
        
        $("#finalizar").click(function () {
            if ($("#acept").prop("checked") == true) {
                let email_val = $("#email").val();
                if (email_val !== '') {
                    $("#form_fin").submit();
                    
                    $("#finalizar").prop("disabled", true);
                    $("#Final").html(`
                        <form action="" method="post">
                            @csrf
                            <div class="row px-3">
                                <div class="col-12 my-5">
                                    <div class="text-center">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <p>Enviando correo..</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" disabled>Finalizar</button>
                            </div>
                        </form>
                    `);
                }else {
                    $("#email").addClass('is-invalid');
                    $("#message_email").html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-triangle"></i></strong> El campo correo es obligatorio.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                }
                console.log(email_val);
            }else {
                $("#form_fin").submit();
                $(this).prop("disabled", true);
                
                $("#Final").html(
                `
                    <form action="" method="post">
                        @csrf
                        <div class="row px-3">
                            <div class="col-12 my-5">
                                <div class="text-center">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p>Finalizando..</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" disabled>Finalizar</button>
                        </div>
                    </form>
                `
                ) ;
            }
            // $("#form_fin").submit();
            // $(this).prop("disabled", true);
            
            // $("#Final").html(
            // `
            //     <form action="" method="post">
            //         @csrf
            //         <div class="row px-3">
            //             <div class="col-12 my-5">
            //                 <div class="text-center">
            //                     <div class="spinner-border" role="status">
            //                         <span class="visually-hidden">Loading...</span>
            //                     </div>
            //                     <p>Finalizar..</p>
            //                 </div>
            //             </div>
            //         </div>
                    
            //         <div class="modal-footer">
            //             <button type="button" class="btn btn-dark" id="finalizar">Finalizar</button>
            //         </div>
            //     </form>
            // `
            // ) ;
        });

        function check() {
            console.log($("#acept").prop("checked") == true);
            if ($("#acept").prop("checked") == true) {
                $("#cont_email").html(
                    `
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo <b style="font-size: 18px; color: red;">*</b></label>
                            <input type="email" class="form-control" id="email" name="correo" aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text">Ingresa un correo donde resibira la confirmación de su aceptación de tratamiento de datos.</div>
                        </div>
                    `
                );
            }else {
                $("#cont_email").html('');
            }
        }
        
        $("#Create_c").click(function () {
            // $("#form_login").submit();
            $(this).addClass("disabled");
            
            $("#content").html(
            `
                <div class="col">
                    <div class="row">
                        <div class="col-12 text-center pb-3">
                            <h1 class=""><b>CREAR CONTACTO.</b> </h1>
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
        
        $(".edit_c").click(function () {
            // $("#form_login").submit();
            $(this).addClass("disabled");
            
            $("#content").html(`
                <div class="col">
                    <div class="row">
                        <div class="col-12 text-center pb-3">
                            <h1 class=""><b>EDITAR CONTACTO.</b> </h1>
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

    </script>
@endsection