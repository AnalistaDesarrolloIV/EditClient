@extends('Pages.inicio.index')
@section('tittle', 'Información personal')

@section('contenido')
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
                                <input type="hidden" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{$usuario['CardCode']}}" name="CardCode" readonly>
                                <input type="hidden" value="{{$usuario['U_HBT_TipDoc']}}" name="U_HBT_TipDoc">
                                    
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        @foreach($tipos as $key => $val)
                                            @if($usuario['U_HBT_TipDoc'] == $tipos[$key]['Code'])
                                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{$tipos[$key]['Name']}}" name="U_HBT_TipDoc_name" readonly>
                                            @endif
                                        @endforeach
                                        <label for="floatingInput">Tipo identificación.</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{$usuario['FederalTaxID']}}" name="FederalTaxID" readonly>
                                        <label for="floatingInput">Identificación.</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{$usuario['CardName']}}" name="CardName" readonly>
                                        <label for="floatingInput">Nombre.</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('Phone1') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{$usuario['Phone1']}}" name="Phone1">
                                        <label for="floatingInput">Telefono 1. <b style="font-size: 18px; color: red;">*</b></label>
                                    @error('Phone1')
                                        <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('Phone2') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{$usuario['Phone2']}}" name="Phone2">
                                        <label for="floatingInput">Telefono 2. <b style="font-size: 18px; color: red;">*</b></label>
                                    @error('Phone2')
                                        <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('EmailAddress') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{$usuario['EmailAddress']}}" name="EmailAddress">
                                        <label for="floatingInput">Correo personal. <b style="font-size: 18px; color: red;">*</b></label>
                                    @error('EmailAddress')
                                        <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('EmailAddress2') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{$usuario['EmailAddress']}}" name="EmailAddress2">
                                        <label for="floatingInput">Correo comercial. <b style="font-size: 18px; color: red;">*</b></label>
                                    @error('EmailAddress2')
                                        <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                    @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="tipo_p" onchange="pedir_doc()" name="" >
                                            <option value="">Tipo de cliente.</option>
                                            <option value="1">Natural.</option>
                                            <option value="2">Independiente.</option>
                                            <option value="3">juridica.</option>
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

                            </div>
                            @if($document != null)
                                <div class="row d-flex justify-content-end mb-4">
                                    <div class="col-12">
                                        <h3><b> Mis archivos.</b></h3>
                                    </div>
                                    <div class="col-12">
                                        <div class="list-group">
                                            
                                            @foreach($document as $key => $val)
                                                <a href="{{$document[$key]['SourcePath']}}/{{$document[$key]['FileName']}}" class="list-group-item list-group-item-action" target="_blank" aria-current="true">
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
@endsection






@section('script')

    <script>
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
                        <label class="input-group-text" for="inputGroupFile01">RUT/Cedula de ciudadania.  <b style=" color: red;">*</b></label>
                        <input type="file" class="form-control d-flex align-content-center @error('Archivos') is-invalid @enderror" id="inputGroupFile01" name="Archivos[]" style="height: 3.5rem;" accept=".pdf" required>
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
                        <label class="input-group-text" for="inputGroupFile01">RUT/Cedula de ciudadania.  <b style=" color: red;">*</b></label>
                        <input type="file" class="form-control d-flex align-content-center @error('Archivos') is-invalid @enderror" id="inputGroupFile01" name="Archivos[]" style="height: 3.5rem;" accept=".pdf" required>
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
                        <label class="input-group-text" for="banco">Camara y comercio.  <b style=" color: red;">*</b></label>
                        <input type="file" class="form-control d-flex align-content-center @error('Archivos') is-invalid @enderror" id="banco" name="Archivos[]" style="height: 3.5rem;" accept=".pdf" required>
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