@extends('Pages.inicio.index')
@section('tittle', 'Crear Dirección')

@section('contenido')
    <div class="toast align-items-center text-white bg-dark border-0 fixed-bottom p-2 my-2 ml-2" id="alert" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
        <div class="d-flex">
            <div class="toast-body">
                    <strong><i class="fas fa-info-circle text-info"></i> </strong>Todos los campos con  (<b style="font-size: 18px; color: red;">*</b>) son obligatorios.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div class="relative flex items-top justify-center min-h-screen  sm:items-center py-2 sm:pt-0">
        <div class="container-fluid mt-3">    
            <div class="row justify-center align-items-center ">
                <div class="col-10">
                    <div class="row op rounded p-4" id="content">
                        <div class="col">
                            <div class="row">
                                <div class="col-12 text-center pb-3">
                                    <h1 class=""><b>CREAR DIRECCIÓN.</b> </h1>
                                </div>
                            </div>
                            <form action="{{route('storeDireccion')}}" method="post" enctype="multipart/form-data" id="form_create_d">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select @error('AddressType') is-invalid @enderror" id="tipo_d"  placeholder="name@example.com" name="AddressType" >
                                                <option value="">Tipo de dirección.</option>
                                                <option value="bo_BillTo">Direccion de facturación.</option>
                                                <option value="bo_ShipTo">Direccion de envío.</option>
                                            </select>
                                            <label for="tipo_d">Tipo de dirección. <b style="font-size: 18px; color: red;">*</b></label>
                                        @error('AddressType')
                                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('Nombre_Direccion') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{old('Nombre_Direccion')}}" name="Nombre_Direccion"  >
                                            <label for="floatingInput">Nombre de sede/establecimieto/granja/sucursal. <b style="font-size: 18px; color: red;">*</b></label>
                                        @error('Nombre_Direccion')
                                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                        @enderror
                                        </div>
                                    </div>
                                
                                    
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="input-group mb-3">
                                                <div class="col-lg-3 col-md-4 col-5">
                                                    <label class="input-group-text" style="height: 3.5rem;" for="depar">Departamento. <b style="font-size: 18px; color: red;">*</b></label>
                                                </div>
                                                <div class="col-lg-9 col-md-8 col-7">
                                                    <select class="form-select select2 @error('Departamento') is-invalid @enderror" id="depar"  placeholder="name@example.com" onchange="citys()" name="Departamento">
                                                        <option value="">Departamento</option>
                                                        <!-- @foreach($dep as $key => $value)
                                                            <option value="{{$dep[$key]['U_NomDepartamento']}}">{{$dep[$key]['U_NomDepartamento']}}</option>
                                                        @endforeach -->
                                                        {{$depa = ''}}
                                                        @foreach($dep as $key => $val)

                                                            @if($depa != $dep[$key]['U_NomDepartamento'])
                                                                <option value="{{$dep[$key]['U_NomDepartamento']}}">{{$dep[$key]['U_NomDepartamento']}}</option>
                                                            @endif

                                                            {{$depa = $dep[$key]['U_NomDepartamento']}}
                                                        @endforeach
                                                    </select>
                                                    @error('Departamento')
                                                        <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select @error('Ciudad') is-invalid @enderror" id="ciudades"  placeholder="name@example.com" name="Ciudad" >
                                                <option value="">Municipio.</option>
                                            </select>
                                            <label for="ciudades">Municipio. <b style="font-size: 18px; color: red;">*</b></label>
                                        @error('Ciudad')
                                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                        @enderror
                                        </div>
                                        
                                    </div> -->
                                    
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="input-group mb-3">
                                                <div class="col-lg-3 col-md-4 col-5">
                                                    <label class="input-group-text" style="height: 3.5rem;" for="ciudades">Municipio. <b style="font-size: 18px; color: red;">*</b></label>
                                                </div>
                                                <div class="col-lg-9 col-md-8 col-7">
                                                    <select class="form-select select2  @error('Ciudad') is-invalid @enderror" id="ciudades" name="Ciudad">
                                                        <option value="">Municipio.</option>
                                                    </select>
                                                    @error('Ciudad')
                                                        <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('Barrio_Vereda_Corregimiento') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{old('Barrio_Vereda_Corregimiento')}}" name="Barrio_Vereda_Corregimiento" >
                                            <label for="floatingInput">Barrio/vereda/corregimiento. <b style="font-size: 18px; color: red;">*</b></label>
                                        @error('Barrio_Vereda_Corregimiento')
                                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                        @enderror
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select @error('Codigo_Postal') is-invalid @enderror" id="floatingSelectGrid" name="Codigo_Postal" >
                                                <option value="">Codigo postal.</option>
                                                @foreach ($postal as $key => $val)
                                                    <option value="{{$postal[$key]['Code']}}">{{$postal[$key]['Code']}}--{{$postal[$key]['U_HBT_Lugar']}}</option>
                                                @endforeach
                                            </select>
                                            <label for="floatingSelectGrid">Codigo postal. <b style="font-size: 18px; color: red;">*</b></label>
                                        @error('Codigo_Postal')
                                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                        @enderror
                                        </div>
                                    </div> -->
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="input-group mb-3">
                                                <div class="col-lg-3 col-md-4 col-5">
                                                    <label class="input-group-text text-center" style="height: 3.5rem;" for="inputGroupSelect01">Codigo postal. <b style="font-size: 18px; color: red;">*</b></label>
                                                </div>
                                                <div class="col-lg-9 col-md-8 col-7">
                                                    <select class="form-select select2  @error('Codigo_Postal') is-invalid @enderror" id="inputGroupSelect01" name="Codigo_Postal">
                                                        <option value="">Codigo postal.</option>
                                                        @foreach ($postal as $key => $val)
                                                            <option value="{{$postal[$key]['Code']}}">{{$postal[$key]['Code']}}--{{$postal[$key]['U_HBT_Lugar']}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('Codigo_Postal')
                                                        <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="select_tipo" onchange="tipocalle()">
                                                <option value="">tipo de vía</option>
                                                <option value="CL">CL--CALLE</option>
                                                <option value="CRA">CRA--CARRERA</option>
                                                <option value="AUT">AUT--AUTOPISTA</option>
                                                <option value="AV">AV--AVENIDA</option>
                                                <option value="CIR">CIR--CIRCULAR</option>
                                                <option value="CRV">CRV--CIRCUNVALAR</option>
                                                <option value="TV">TV--TRANSVERSAL</option>
                                                <option value="VTE">VTE--VARIANTE</option>
                                            </select>
                                            <label for="select_tipo">Tipo de vía.</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="num_calle" placeholder="name@example.com" onchange="numerocalle()" >
                                            <label for="num_calle" id="textonumero">Nombre de vía - cuadrante.</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="numero_lugar" placeholder="name@example.com" onchange="num_lugar()" >
                                            <label for="numero_lugar">Numero de vía generadora.</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="numero_local" placeholder="name@example.com" onchange="num_local()">
                                            <label for="numero_local">Numero de placa.</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('Direccion_fisica') is-invalid @enderror" id="direccion_completa" placeholder="name@example.com" value="{{old('Direccion_fisica')}}" name="Direccion_fisica" readonly >
                                            <label for="direccion_completa">Dirección fisica. <b style="font-size: 18px; color: red;">*</b></label>
                                        @error('Direccion_fisica')
                                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                        @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control @error('Identificacion') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{$_SESSION['USER']}}" name="Identificacion" readonly >
                                            
                                </div>
                                <div class="row d-flex justify-content-end mb-4">
                                    <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                        <button type="button" class="btn btn-dark text-white" id="btnCreate" data-bs-toggle="tooltip" data-bs-placement="top" title="Finalizar creación de dirección">Crear</button>
                                    </div>
                                    <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                        <a href="{{route('infoDirecciones')}}" class="btn btn-outline-dark" onclick="volver()" id="atras" data-bs-toggle="tooltip" data-bs-placement="top" title="Volver a la pagina principal de direcciones">Volver</a>
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
        .activar2{
            border-bottom: white solid 2px;
        }
        .select2{
        width: 100%!important;
        
        }
        .select2-container--bootstrap-5 .select2-selection{
            min-height:3.5rem!important;
        }
        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            padding-top: 10px!important;
        }
        .select2-container .select2-selection--single .select2-selection__rendered{
            padding-right: 0px!important;
        }
        .select2-container--bootstrap-5 .select2-selection--single{
            background-position: right 0.75rem center!important;
        }
        .hov_menu:hover{
            background: rgba(0,0,0,0.3);
            position: absolute;
        }
    </style>
@endsection

@section('script')
    <script>
        
        $(document).ready(function() {
            $('#alert').toast('show');
        });

        function citys() {
            var array = '<?php echo json_encode($dep)?>';

            let arreglo = JSON.parse(array);

            $('#ciudades').text($('<option>').val('').text(''));
            $('#ciudades').append($('<option>').val('').text('Municipio'));

            arreglo.forEach(element => {
                
                let depa = $('#depar option:selected' ).text();
                if (element['U_NomDepartamento'] == depa) {
                    let city = element['Name'];
                    let codigo = element['Code']
                    $('#ciudades').append($('<option>').val(codigo).text(city));
                }
            });
            
            
        }

        function tipocalle() {
            let tipo = $("#select_tipo option:selected").val();
            $("#direccion_completa").val(tipo);
            $("#textonumero b").text(tipo);
        }

        function numerocalle(){
            
            let num_c = $("#num_calle").val();
            let dir = $("#direccion_completa").val() || "";
            $("#direccion_completa").val(dir+" "+num_c);
        }

        function num_lugar(){
            let lugar = $("#numero_lugar").val();
            let dir = $("#direccion_completa").val() || "";
            $("#direccion_completa").val(dir+" # "+lugar);
        }
        function num_local(){
            let local = $("#numero_local").val();
            let dir = $("#direccion_completa").val() || "";
            $("#direccion_completa").val(dir+" - "+local);
        }
        function volver() {

            $("#atras").addClass("disabled");
            
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
        }

        $("#btnCreate").click(function () {
            $("#form_create_d").submit();
            $(this).addClass("disabled");
            
            $(this).html(`
                <span class="spinner-border spinner-border-sm"
                role="status" aria-hidden="true"></span> Creando...
            `);
        });

    </script>
@endsection