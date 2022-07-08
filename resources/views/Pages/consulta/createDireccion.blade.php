@extends('Pages.inicio.index')
@section('tittle', 'Crear Dirección')

@section('contenido')
{{session_start();}}
<div class="relative flex items-top justify-center min-h-screen  sm:items-center py-2 sm:pt-0">
    <div class="container-fluid mt-3">    
        <div class="row justify-center align-items-center ">
            <div class="col-10">
                <div class="row op rounded p-4">
                <div class="col">
                    <div class="row">
                        <div class="col-12 text-center pb-3">
                            <h1 class=""><b>CREAR DIRECCIÓN.</b> </h1>
                        </div>
                    </div>
                    <form action="/storeDireccion" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('Nombre_Direccion') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="" name="Nombre_Direccion"  required>
                                    <label for="floatingInput">Nombre Dirección. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                                @error('Nombre_Direccion')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select select2" id="depar"  placeholder="name@example.com" onchange="citys()" name="Departamento" required>
                                        <option value="">Departamento</option>
                                        @foreach($dep as $key => $value)
                                            <option value="{{$dep[$key]['departamento']}}">{{$dep[$key]['departamento']}}</option>
                                        @endforeach
                                    </select>
                                    <label for="depar">Departamento.</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select select2" id="ciudades"  placeholder="name@example.com" name="Ciudad" required>
                                        <option value="">Municipio.</option>
                                    </select>
                                    <label for="ciudades">Municipio.</label>
                                </div>
                                
                            </div>
                            
                            
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="" name="Barrio_Vereda_Corregimiento" required>
                                    <label for="floatingInput">Barrio/vereda/corregimiento. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="floatingSelectGrid" name="Codigo_Postal" required>
                                        <option value="1">250030-Madrid, Cundinamarca</option>
                                        <option value="2">250030-Madrid, Cundinamarca</option>
                                    </select>
                                    <label for="floatingSelectGrid">Codigo postal. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-lg-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="select_tipo" onchange="tipocalle()">
                                        <option value="0">tipo de calle</option>
                                        <option value="1">CL</option>
                                        <option value="2">CRA</option>
                                    </select>
                                    <label for="select_tipo">Tipo de calle.</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="num_calle" placeholder="name@example.com" onchange="numerocalle()" >
                                    <label for="num_calle" id="textonumero">Numero <b></b>.</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="numero_lugar" placeholder="name@example.com" onchange="num_lugar()" >
                                    <label for="numero_lugar">Numero lugar.</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="numero_local" placeholder="name@example.com" onchange="num_local()">
                                    <label for="numero_local">Numero local.</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="direccion_completa" placeholder="name@example.com" value="" name="Direccion_fisica" readonly required>
                                    <label for="direccion_completa">Dirección fisica. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{$_SESSION['USER']}}" name="Identificacion" required>
                                    <label for="floatingInput">NIT/Cedula de Ciudadania. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            
                            <!-- <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="paises" name="" required>

                                    </select>
                                    <label for="paises">Pais. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div> -->
                        </div>
                        
                        <div class="row d-flex justify-content-end mb-4">
                            <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                <button type="submit" class="btn btn-dark text-white">Crear</button>
                            </div>
                            <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                <a href="/ndir" class="btn btn-outline-dark">Volver</a>
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


@section('script')
<script>
    
    // fetch('https://raw.githubusercontent.com/millan2993/countries/master/json/countries.json')
    // .then((res) => {
    //   return res.json();
    // }).then((array) => {
    //     console.log(array['countries']);
    //     array['countries'].forEach(element => {
    //         $('#paises').append($('<option>').val(element['id']).text(element['name']))
    //     });
    //     let depa = $('#depar option:selected' ).text();
    //     array.forEach( element => {
    //         if (element['departamento'] == depa) {
    //             console.log(element['departamento']);
    //                 $('#ciudades').text($('<option>').val('').text(''));
    //                 $('#ciudades').append($('<option>').val('').text('Municipio.'));
    //                 element['ciudades'].forEach(city => {
    //                     $('#ciudades').append($('<option>').val(city).text(city));
    //                 });
    //         }
    //     });
    //  } )

function citys() {
    
    fetch('https://raw.githubusercontent.com/marcovega/colombia-json/master/colombia.json')
    .then((res) => {
      return res.json();
    }).then((array) => {
        let depa = $('#depar option:selected' ).text();
        array.forEach( element => {
            if (element['departamento'] == depa) {
                console.log(element['departamento']);
                    $('#ciudades').text($('<option>').val('').text(''));
                    $('#ciudades').append($('<option>').val('').text('Municipio.'));
                    element['ciudades'].forEach(city => {
                        $('#ciudades').append($('<option>').val(city).text(city));
                    });
            }
        });
     } )
     
}


function tipocalle() {
    let tipo = $("#select_tipo option:selected").text();
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


</script>
@endsection