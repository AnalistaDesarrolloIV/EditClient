@extends('Pages.inicio.index')
@section('tittle', 'Información personal')

@section('contenido')
        <div class="toast align-items-center text-white bg-dark border-0 fixed-bottom py-2 my-2 ml-2" id="alert1" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
            <div class="d-flex">
                <div class="toast-body">
                <i class="fas fa-exclamation-triangle text-warning"></i> Debes haber agregado un primer correo comercial.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>

        <div class="toast align-items-center text-white bg-dark border-0 fixed-bottom py-2 my-2 ml-2" id="alert2" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
            <div class="d-flex">
                <div class="toast-body">
                <i class="fas fa-exclamation-triangle text-warning"></i> Solo puedes agregar hasta 5 correos comerciales.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>

<div class="relative flex items-top justify-center min-h-screen  sm:items-center py-4 sm:pt-0">
    <div class="container-fluid mt-5"> 
        <div class="row justify-center align-items-center ">
            <div class="col-md-10 col-12">
                <div class="row op rounded p-4 pt-3">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 text-center ">
                                <h1 class=""><b>INFORMACIÓN PERSONAL.</b> </h1>
                            </div>
                        </div>


                        <form action="npersonaledit" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" value="{{$usuario['AttachmentEntry']}}" name="AttachmentEntry">
                                <input type="hidden" value="{{$usuario['CardCode']}}" name="CardCode">
                                <input type="hidden" value="{{$usuario['U_HBT_TipDoc']}}" name="U_HBT_TipDoc">
                                    
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        @foreach($tipos as $key => $val)
                                            @if($usuario['U_HBT_TipDoc'] == $tipos[$key]['Code'])
                                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" 
                                                value="{{$tipos[$key]['Name']}}" name="U_HBT_TipDoc_name"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip"
                                                title="Campo tipo de documento ineditable." readonly>
                                            @endif
                                        @endforeach
                                        <label for="floatingInput">Tipo identificación.</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"
                                         value="{{$usuario['FederalTaxID']}}" name="FederalTaxID" 
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip"
                                        title="Campo numero de identificacion ineditable."
                                         readonly>
                                        <label for="floatingInput">Identificación.</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" 
                                        value="{{$usuario['CardName']}}" name="CardName" 
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip"
                                        title="Campo nombre ineditable, en caso de estar mal escrito o desee edirlo debera solicitarlo a la empresa."
                                        readonly>
                                        <label for="floatingInput">Nombre.</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('Phone1') is-invalid @enderror" id="floatingInput"
                                        placeholder="name@example.com" value="{{$usuario['Phone1']}}" name="Phone1"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip"
                                        title="Campo numero de telefono 1 editable y obligatorio.">
                                        <label for="floatingInput">Telefono 1. <b style="font-size: 18px; color: red;">*</b></label>
                                    @error('Phone1')
                                        <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('Phone2') is-invalid @enderror" id="floatingInput"
                                        placeholder="name@example.com" value="{{$usuario['Phone2']}}" name="Phone2"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip"
                                        title="Campo numero de telefono 2 editable y no obligatorio.">
                                        <label for="floatingInput">Telefono 2.</label>
                                    @error('Phone2')
                                        <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('EmailAddress') is-invalid @enderror" id="floatingInput" 
                                        placeholder="name@example.com" value="{{$usuario['EmailAddress']}}" name="EmailAddress"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip"
                                        title="Campo correo de facturación editable, obligatorio y necesita confirmación.">
                                        <label for="floatingInput">Correo Facturación electronica. <b style="font-size: 18px; color: red;">*</b></label>
                                    @error('EmailAddress')
                                        <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('EmailAddress_confirmation') is-invalid @enderror" id="confirmEmail" 
                                        placeholder="name@example.com" name="EmailAddress_confirmation"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip"
                                        title="Campo confirmación de correo de facturación electronica editable y obligatorio.">
                                        <label for="confirmEmail">Confirmar correo facturación electronica. <b style="font-size: 18px; color: red;">*</b></label>
                                    @error('EmailAddress_confirmation')
                                        <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-md-8 col-12">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control @error('comerciales') is-invalid @enderror" id="email_com" 
                                        placeholder="name@example.com" value="" name="comerciales[]"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip"
                                        title="Campo correo comercial editable y obligatorio por lo menos 1.">
                                        <label for="email_com">Correo comercial. <b style="font-size: 18px; color: red;">*</b></label>
                                    @error('comerciales')
                                        <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="row d-flex justify-content-end">
                                        <div class="col-12 pb-3 pb-md-0 d-grid gap-2">
                                            <button type="button" class="btn btn-dark text-white"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-custom-class="custom-tooltip"
                                                    title="Botón para agregar un correo comercial extra, en caso de ser requerido."
                                                    onclick="correos()" style="height: 3.5rem">
                                                <i class="fas fa-plus-circle"></i> Agregar correo comercial
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12" id="emails">
                                    <div class="row">

                                    </div>
                                </div>

                                
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="tipo_p" onchange="pedir_doc()" name="" 
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip"
                                        title="Campo tipo de cliente, para identificar los documentos que debera adjuntar.">
                                            <option value="">Tipo de cliente.</option>
                                            <option value="1">Natural.</option>
                                            <option value="2">Independiente / Sin estblecimiento de comercio.</option>
                                            <option value="3">juridica / Con establecimiento de comercio.</option>
                                        </select>
                                        <label for="tipo_d">Tipo de cliente.</label>
                                    </div>
                                </div>
                                <div class="col-12" id="cc_nit">

                                </div>
                                <div class="col-12" id="banco">

                                </div>
                                <div class="col-12" id="c_c">

                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                            @if(isset($usuario['FreeText']))
                                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" 
                                                style="height: 100px" name="coments"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip"
                                                title="Campo comentarios editable y es para poner sus sujerencias incluyendo si desea cambiar algo en los campos ineditables.">{{$usuario['FreeText']}}</textarea>
                                            @else
                                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" 
                                                style="height: 100px" name="coments"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip"
                                                title="Campo comentarios editable y es para poner sus sujerencias incluyendo si desea cambiar algo en los campos ineditables."></textarea>
                                            @endif
                                        <label for="floatingTextarea2">Comentarios.</label>
                                    </div>
                                </div>

                            </div>
                            @if($document != null)
                                <div class="row d-flex justify-content-end my-4">
                                    <div class="col-12 text-center">
                                        <h3><b> Mis archivos.</b></h3>
                                    </div>
                                    <div class="col-12">
                                        <div class="list-group">
                                            
                                            @foreach($document as $key => $val)
                                                <a href="{{$document[$key]['SourcePath']}}/{{$document[$key]['FileName']}}" class="list-group-item list-group-item-action" 
                                                target="_blank" aria-current="true"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip"
                                                title="Botón para visualizar el archivo en una nueva pestaña.">
                                                    {{$document[$key]['FileName']}}
                                                </a>
                                            @endforeach

                                        </div>
                                    </div>
                                    <!-- @foreach($document as $key => $val)
                                        <div class="col">
                                            <a class="btn btn-info" href="{{$document[$key]['SourcePath']}}/{{$document[$key]['FileName']}}" target="_blank">ver-{{$document[$key]['FileName']}}</a> 
                                        </div>
                                    @endforeach -->
                                </div>
                            @endif
                            <div class="row d-flex justify-content-end my-2">
                                <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                    <button type="submit" class="btn btn-dark text-white">Editar y siguiente <i class="fas fa-angle-double-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
<div class="col-12">

</div>
@endsection






@section('script')

    <script>
        let cont = 1;
        function correos() {
            if (cont < 5) {  
                if ($('#email_com').val() != "") {
                    $('#emails .row').append(`
                        <div class="col-md-6 col-12">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('comerciales') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="" name="comerciales[]">
                                <label for="floatingInput">Correo comercial `+(cont+1)+`. </label>
                            @error('comerciales')
                                <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                            @enderror
                            </div>
                        </div>
                    `);
                    cont += 1;
                    console.log(cont);
                }else{
                    
                    $('#alert1').toast('show');

                    // $('#alerta').append(`
                    // <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    //     <div class="toast-header">
                    //         <img src="..." class="rounded me-2" alt="...">
                    //         <strong class="me-auto">Bootstrap</strong>
                    //         <small class="text-muted">11 mins ago</small>
                    //         <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    //     </div>
                    //     <div class="toast-body">
                    //         Hello, world! This is a toast message.
                    //     </div>
                    // </div>
                    // `);
                    // Swal.fire({
                    //     icon: 'warning',
                    //     title: '¡Atención!',
                    //     text: 'Debes haber agregado un primer correo comercial.',
                    // })
                }
            }else{
                    $('#alert2').toast('show');

                    // $('#alerta').append(`
                    //     <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    //         <strong>¡Atención!</strong> Solo puedes agregar hasta 5 correos comerciales.
                    //         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    //     </div>
                    // `);
                    // Swal.fire({
                    //     icon: 'warning',
                    //     title: '¡Atención!',
                    //     text: 'Solo puedes agregar hasta 5 correos comerciales.',
                    // })
            }
            
          
        }

        function pedir_doc() {
            let tipoP = $("#tipo_p option:selected").val();
            if (tipoP == 1) {
                $("#cc_nit").text(``);
                $("#banco").text(``);
                $("#c_c").text(``);
                $("#cc_nit").append(`
                <div class="input-group mb-3">
                    <label class="input-group-text" for="doc_cc_nit">RUT/Cedula de ciudadania.  <b style=" color: red;">*</b></label>
                    <input type="file" class="form-control d-flex align-content-center @error('Archivos') is-invalid @enderror" id="doc_cc_nit" name="Archivos[]" style="height: 3.5rem;" accept=".pdf" required>
                    @error('Archivos')
                        <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                    @enderror
                </div>
                `);
            }else if(tipoP == 2) {
                $("#cc_nit").text(``);
                $("#banco").text(``);
                $("#c_c").text(``);

                $("#cc_nit").append(`
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="doc_cc_nit">RUT/Cedula de ciudadania.  <b style=" color: red;">*</b></label>
                        <input type="file" class="form-control d-flex align-content-center @error('Archivos') is-invalid @enderror" id="doc_cc_nit" name="Archivos[]" style="height: 3.5rem;" accept=".pdf" required>
                        @error('Archivos')
                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                `);
                $("#banco").append(`
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="banco">Certficado Bancario.  <b style=" color: red;">*</b></label>
                        <input type="file" class="form-control d-flex align-content-center @error('Archivos') is-invalid @enderror" id="banco" name="Archivos[]" style="height: 3.5rem;" accept=".pdf" required>
                        @error('Archivos')
                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                `);
            }else if(tipoP == 3){
                $("#cc_nit").text(``);
                $("#banco").text(``);
                $("#c_c").text(``);

                $("#cc_nit").append(`
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="doc_cc_nit">RUT/Cedula de ciudadania.  <b style=" color: red;">*</b></label>
                        <input type="file" class="form-control d-flex align-content-center @error('Archivos') is-invalid @enderror" id="doc_cc_nit" name="Archivos[]" style="height: 3.5rem;" accept=".pdf" required>
                        @error('Archivos')
                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                `);
                $("#banco").append(`
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="banco">Certficado Bancario.  <b style=" color: red;">*</b></label>
                        <input type="file" class="form-control d-flex align-content-center @error('Archivos') is-invalid @enderror" id="banco" name="Archivos[]" style="height: 3.5rem;" accept=".pdf" required>
                        @error('Archivos')
                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                `);
                $("#c_c").append(`
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="camara_c">Camara y comercio.  <b style=" color: red;">*</b></label>
                        <input type="file" class="form-control d-flex align-content-center @error('Archivos') is-invalid @enderror" id="camara_c" name="Archivos[]" style="height: 3.5rem;" accept=".pdf" required>
                        @error('Archivos')
                            <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                `);
            }else{
                $("#cc_nit").text(``);
                $("#banco").text(``);
                $("#c_c").text(``);
            }
        }
    </script>

@endsection