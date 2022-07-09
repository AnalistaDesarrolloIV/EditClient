@extends('Pages.inicio.index')
@section('tittle', 'Crear Contacto')

@section('contenido')
{{session_start();}}
<div class="relative flex items-top justify-center min-h-screen  sm:items-center py-4 sm:pt-0">
    <div class="container-fluid mt-5">    
        <div class="row justify-center align-items-center ">
            <div class="col-10">
                <div class="row op rounded p-4">
                <div class="col">
                    <div class="row">
                        <div class="col-12 text-center pb-3">
                            <h1 class=""><b>CREAR CONTACTO.</b> </h1>
                        </div>
                    </div>
                    <form action="/storeContacto" method="post" enctype="multipart/form-data">
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
                                    <select class="form-select" id="floatingSelectGrid"  name="Name" required>
                                        <option value="" readonly>Selecionar</option>
                                        <option value="Contador">Contador</option>
                                        <option value="Tesorero">Tesorero</option>
                                        <option value="Comercial">Comercial</option>
                                        <option value="Logistico">Logistico</option>
                                    </select>
                                    <label for="floatingSelectGrid">Tipo Contacto. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('Nombre_Direccion') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="" name="FirstName"  required >
                                    <label for="floatingInput">Primer nombre. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('Nombre_Direccion') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="" name="MiddleName"  >
                                    <label for="floatingInput">Segundo nombre.</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('Nombre_Direccion') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="" name="LastName"  required >
                                    <label for="floatingInput">Apellidos. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('Nombre_Direccion') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="" name="Profession"  required >
                                    <label for="floatingInput">Cargo. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            
                            <div class="col-lg-2 col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('Nombre_Direccion') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="" name="Ext1"   >
                                    <label for="floatingInput">Extención 1. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-8">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="" name="Phone1" >
                                    <label for="floatingInput">Telefono 1. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('Nombre_Direccion') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="" name="Ext2"   >
                                    <label for="floatingInput">Extención 2.</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-8">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="" name="Phone2">
                                    <label for="floatingInput">Telefono 2.</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="" name="MobilePhone" required>
                                    <label for="floatingInput">Movil. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="" name="E_Mail">
                                    <label for="floatingInput">Correo. <b style="font-size: 18px; color: red;">*</b></label>
                                </div>
                            </div>
                        
                        <div class="row d-flex justify-content-end mb-5">
                            <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                <button type="submit" class="btn btn-dark text-white">Crear</button>
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

</script>
@endsection