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
                                @if($usuario['AttachmentEntry'] != null)
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="inputGroupFile01">RUT/Cedula de ciudadania.</label>
                                        <input type="file" class="form-control d-flex align-content-center @error('IdentificacionArch') is-invalid @enderror" id="inputGroupFile01" name="IdentificacionArch" style="height: 3.5rem;" accept=".pdf" >
                                    @error('IdentificacionArch')
                                        <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                    @enderror
                                    </div>
                                </div>
                                @else
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="inputGroupFile01">RUT/Cedula de ciudadania.  <b style=" color: red;">*</b></label>
                                            <input type="file" class="form-control d-flex align-content-center @error('IdentificacionArch') is-invalid @enderror" id="inputGroupFile01" name="IdentificacionArch" style="height: 3.5rem;" accept=".pdf" required>
                                    @error('IdentificacionArch')
                                        <div class="alert alert-danger mt-1 mb-1"><small>{{ $message }}</small></div>
                                    @enderror
                                        </div>
                                @endif
                                <!-- <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" value="{{$usuario['AttachmentEntry']}}" name="AttachmentEntry">
                                        <label for="floatingInput">Anexos. <b style="font-size: 18px; color: red;">*</b></label>
                                    </div>
                                </div> -->
                            </div>
                            @if($usuario['AttachmentEntry'] != null)
                                <div class="row d-flex justify-content-end mb-2">
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
                            <div class="row d-flex justify-content-end mb-2">
                                <div class="col-12 col-md-4 pb-3 pb-md-0 d-grid gap-2">
                                    <button type="submit" class="btn btn-dark text-white">Editar</button>
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
