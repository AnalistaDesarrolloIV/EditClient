@extends('Pages.inicio.index')
@section('tittle', 'Editar Contacto')

@section('contenido')
<div class="relative flex items-top justify-center min-h-screen  sm:items-center py-4 sm:pt-0">
    <div class="container-fluid mt-5">    
        <div class="row justify-center align-items-center ">
            <div class="col-10">
                <div class="row op rounded p-4">
                <div class="col">
                    <div class="row">
                        <div class="col-12 text-center pb-3">
                            <h1 class=""><b>EDITAR CONTACTO.</b> </h1>
                        </div>
                    </div>
                    <form action="/ncontupdate/{{$contacto['InternalCode']}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" class="form-control @error('Nombre_Direccion') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{$contacto['CardCode']}}" name="CardCode" readonly required >
                           
                            <!-- <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('Nombre_Direccion') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{$contacto['Name']}}" name="Name" required >
                                    <label for="floatingInput">Contacto. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div> -->
                            <!-- <div class="col-12">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="floatingSelectGrid"  name="Name" readonly required>
                                        <option value="{{$contacto['Name']}}" readonly>{{$contacto['Name']}}</option>
                                        <option value="Contador">Contador</option>
                                        <option value="Tesorero">Tesorero</option>
                                        <option value="Comercial">Comercial</option>
                                        <option value="Logistico">Logistico</option>
                                    </select>
                                    <label for="floatingSelectGrid">Tipo Contacto. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div> -->
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" value="{{$contacto['Name']}}" name="Name" readonly required >
                                    <label for="floatingInput">Tipo Contacto.</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('Nombre_Direccion') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{$contacto['FirstName']}}" name="FirstName"  required >
                                    <label for="floatingInput">Primer nombre. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('Nombre_Direccion') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{$contacto['MiddleName']}}" name="MiddleName" >
                                    <label for="floatingInput">Segundo nombre.</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('Nombre_Direccion') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{$contacto['LastName']}}" name="LastName"  required >
                                    <label for="floatingInput">Apellidos. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('Nombre_Direccion') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{$contacto['Profession']}}" name="Profession"  required >
                                    <label for="floatingInput">Cargo. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('Nombre_Direccion') is-invalid @enderror" id="ext1" placeholder="name@example.com" value="" name="Ext1">
                                    <label for="ext1">Extención 1. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-8">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="tel1" placeholder="name@example.com" value="" name="Phone1">
                                    <label for="tel1">Telefono 1. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('Nombre_Direccion') is-invalid @enderror" id="ext2" placeholder="name@example.com" value="" name="Ext2"   >
                                    <label for="ext2">Extención 2.</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-8">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="tel2" placeholder="name@example.com" value="" name="Phone2">
                                    <label for="tel2">Telefono 2. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{$contacto['MobilePhone']}}" name="MobilePhone" required>
                                    <label for="floatingInput">Movil. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{$contacto['E_Mail']}}" name="E_Mail" >
                                    <label for="floatingInput">Correo. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                        
                        <div class="row d-flex justify-content-end mb-5">
                            <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                <button type="submit" class="btn btn-dark text-white">Editar</button>
                            </div>
                            <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                <a href="/ncont" class="btn btn-outline-dark">Volver</a>
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
    if ("{{$contacto['Phone1']}}" != "") {
        let telefono1 = "{{$contacto['Phone1']}}";
        let limit = telefono1.search("-");
        if (limit > 1) {
            let limitetel = limit +=2;
            let limitext = limit -=6;
            $('#ext1').val(telefono1.substr(2, limitext));
            $('#tel1').val(telefono1.substr(limitetel));
        }else{
            $('#tel1').val(telefono1);
        }
    }

    if ("{{$contacto['Phone2']}}" != "") {
        let telefono2 = "{{$contacto['Phone2']}}";
        let limit2 = telefono2.search("-");
        if (limit2 > 1) {
            let limitetel2 = limit +=2;
            let limitext2 = limit -=6;
            $('#ext2').val(telefono2.substr(2, limitext));
            $('#tel2').val(telefono2.substr(limitetel));
        }else{
            $('#tel2').val(telefono2);
        }
    }
    


</script>
@endsection