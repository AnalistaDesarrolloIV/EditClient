@extends('Pages.inicio.index')
@section('tittle', 'Información personal')

@section('contenido')
<div class="relative flex items-top justify-center min-h-screen  sm:items-center py-4 sm:pt-0">
    <div class="container-fluid mt-5">    
        <div class="row justify-center align-items-center ">
            <div class="col-10">
                <div class="row op rounded p-4">
                <div class="col">
                    <div class="row">
                        <div class="col-12 text-center pb-5">
                            <h1 class=""><b>INFORMACIÓN PERSONAL.</b> </h1>
                        </div>
                    </div>
                    <form action="npersonaledit" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{$usuario['CardCode']}}" name="CardCode" readonly>
                                    <label for="floatingInput">Codigo.</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{$usuario['U_HBT_TipDoc']}}" name="U_HBT_TipDoc" readonly>
                                    <label for="floatingInput">Tipo identificación.</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{$usuario['FederalTaxID']}}" name="FederalTaxID" readonly>
                                    <label for="floatingInput">Identificación.</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{$usuario['CardName']}}" name="CardName" readonly>
                                    <label for="floatingInput">Nombre.</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{$usuario['Phone1']}}" name="Phone1" required>
                                    <label for="floatingInput">Telefono 1. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{$usuario['Phone2']}}" name="Phone2" required>
                                    <label for="floatingInput">Telefono 2. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{$usuario['EmailAddress']}}" name="EmailAddress" required>
                                    <label for="floatingInput">Correo personal. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{$usuario['EmailAddress']}}" name="EmailAddress" required>
                                    <label for="floatingInput">Correo comercial. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <!-- <div class=" mb-3"> -->
                                    <!-- <label for="formFileLg" class="form-label"></label>
                                    <input class="form-control form-control-lg" id="formFileLg" type="file" accept=".pdf,image/*"> -->
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="inputGroupFile01">RUT/Cedula de ciudadania.  <b style=" color: red;">*</b></label>
                                        <input type="file" class="form-control d-flex align-content-center" id="inputGroupFile01" name="IdentificacionArch" style="height: 3.5rem;" accept=".pdf,image/*" >
                                    </div>
                                <!-- </div> -->
                            </div>
                        </div>
                        
                        <div class="row d-flex justify-content-end mb-3">
                            <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                <button type="submit" class="btn btn-dark text-white">Editar</button>
                            </div>
                            <!-- <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                <a href="{{ route('info.index')}}" class="btn btn-outline-dark">Volver</a>
                            </div> -->
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection
