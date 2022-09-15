@extends('Pages.inicio.index')
@section('tittle', 'Crear Contacto')

@section('contenido')
    {{session_start();}}
    <div class="toast align-items-center text-white bg-dark border-0 fixed-bottom p-2 my-2 ml-2" id="alert" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="10000">
        <div class="d-flex">
            <div class="toast-body">
                    <strong><i class="fas fa-info-circle text-info"></i> </strong>Todos los campos con  (<b style="font-size: 18px; color: red;">*</b>) son obligatorios.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>

    <div class="relative flex items-top justify-center min-h-screen  sm:items-center py-4 sm:pt-0">
        <div class="container-fluid mt-5">    
            <div class="row justify-center align-items-center ">
                <div class="col-10">
                    <div class="row op rounded p-4" id="content">
                        <div class="col">
                            <div class="row">
                                <div class="col-12 text-center pb-3">
                                    <h1 class=""><b>CREAR CONTACTO.</b> </h1>
                                </div>
                            </div>
                            <form action="{{route('storeContacto')}}" method="post" enctype="multipart/form-data" id="form_create_c">
                                @csrf
                                <div class="row">
                                    <!-- <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('Nombre_Direccion') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="" name="Name" required >
                                            <label for="floatingInput">Contacto. <b style="font-size: 18px; color: red;">*</b></label>
                                        </div>
                                    </div> -->
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-select @error('Name') is-invalid @enderror" id="floatingSelectGrid"  name="Name">
                                                <option value="" readonly>Selecionar</option>
                                                <option value="Contador">Contador</option>
                                                <option value="Tesorero">Tesorero</option>
                                                <option value="Comercial">Comercial</option>
                                                <option value="Logistico">Logistico</option>
                                            </select>
                                            <label for="floatingSelectGrid">Tipo Contacto. <b style="font-size: 18px; color: red;">*</b></label>
                                        @error('Name')
                                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('FirstName') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{old('FirstName')}}" name="FirstName">
                                            <label for="floatingInput">Primer nombre. <b style="font-size: 18px; color: red;">*</b></label>
                                        @error('FirstName')
                                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('MiddleName') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{old('MiddleName')}}" name="MiddleName">
                                            <label for="floatingInput">Segundo nombre.</label>
                                        @error('MiddleName')
                                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('LastName') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{old('LastName')}}" name="LastName">
                                            <label for="floatingInput">Apellidos. <b style="font-size: 18px; color: red;">*</b></label>
                                        @error('LastName')
                                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('Profession') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{old('Profession')}}" name="Profession">
                                            <label for="floatingInput">Cargo. <b style="font-size: 18px; color: red;">*</b></label>
                                        @error('Profession')
                                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                        @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-8">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('Phone1') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{old('Phone1')}}" name="Phone1">
                                            <label for="floatingInput">Telefono 1.</label>
                                        @error('Phone1')
                                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('Ext1') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{old('Ext1')}}" name="Ext1">
                                            <label for="floatingInput">Extension 1.</label>
                                        @error('Ext1')
                                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-8">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('Phone2') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{old('Phone2')}}" name="Phone2">
                                            <label for="floatingInput">Telefono 2.</label>
                                        @error('Phone2')
                                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('Ext2') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{old('Ext2')}}" name="Ext2">
                                            <label for="floatingInput">Extension 2.</label>
                                        @error('Ext2')
                                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('MobilePhone') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{old('MobilePhone')}}" name="MobilePhone">
                                            <label for="floatingInput">Movil. <b style="font-size: 18px; color: red;">*</b></label>
                                        @error('MobilePhone')
                                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control @error('E_Mail') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{old('E_Mail')}}" name="E_Mail">
                                            <label for="floatingInput">Correo.</label>
                                        @error('E_Mail')
                                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                        @enderror
                                        </div>
                                    </div>
                                
                                <div class="row d-flex justify-content-end mb-5">
                                    <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                        <button type="button" class="btn btn-dark text-white" id="btnCreate">Crear</button>
                                    </div>
                                    <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                        <a href="{{route('infoContactos')}}" onclick="volver()" id="atras" class="btn btn-outline-dark">Volver</a>
                                    </div>
                                </div>
                            </form>
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
    </style>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#alert').toast('show');
        });

        function volver() {

            $("#atras").addClass("disabled");

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
        }

        $("#btnCreate").click(function () {
            $("#form_create_c").submit();
            $(this).addClass("disabled");

            $(this).html(`
                <span class="spinner-border spinner-border-sm"
                role="status" aria-hidden="true"></span> Creando...
            `);
        });
    </script>
@endsection