@extends('Pages.inicio.index')

@section('tittle', 'Direcciones')

@section('contenido')

<div class="relative flex items-top justify-center min-h-screen  sm:items-center sm:pt-0">
    <div class="container-fluid mt-5">    
        <div class="row justify-center align-items-center ">
            <div class="col-12">
                <div class="row op rounded p-4 pb-2 mt-3">
                    <div class="col">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h1 class=""><b>DIRECCIONES.</b> </h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 pb-4">
                                <div class="d-grid gap-2">
                                    <a href="/ndircreate" class="btn btn-dark" ><i class="fas fa-plus-circle"></i> Agregar dirección</a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <h3><strong>Direcciones de envío.</strong></h3>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-bordered border-dark" id="dt">
                                        <thead>
                                            <tr>
                                                <th>Acciones</th>
                                                <th>#ID</th>
                                                <th>Nombre de dirección</th>
                                                <th>Dirección fisica</th>
                                                <th>Departamento</th>
                                                <th>Ciudad</th>
                                                <th>Barrio/Vereda/Corregimiento</th>
                                                <th>Codigo postal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($direccion as $key => $val)
                                                @if($direccion[$key]['Tipo_Direccion'] == "S")
                                                    <tr>
                                                        <td class="text-center"><a href="/ndiredit/{{$direccion[$key]['LineNum']}}"><i class="fas fa-pen"></i></a></td>
                                                        <td>{{$direccion[$key]['LineNum']}}</td>
                                                        <td>{{$direccion[$key]['Nombre_Direccion']}}</td>
                                                        <td>{{$direccion[$key]['Direccion_fisica']}}</td>
                                                        <td>{{$direccion[$key]['Departamento']}}</td>
                                                        <td>{{$direccion[$key]['Ciudad']}}</td>
                                                        <td>{{$direccion[$key]['Barrio_Vereda_Corregimiento']}}</td>
                                                        <td>{{$direccion[$key]['Codigo_Postal']}}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-5">
                            <div class="col-12 text-center">
                                <h3><strong>Direcciones de facturación.</strong></h3>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-bordered border-dark" id="dt_2">
                                        <thead>
                                            <tr>
                                                <th>Acciones</th>
                                                <th>#ID</th>
                                                <th>Nombre dirección</th>
                                                <th>Dirección fisica</th>
                                                <th>Departamento</th>
                                                <th>Ciudad</th>
                                                <th>Barrio/Vereda/Corregimiento</th>
                                                <th>Codigo postal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($direccion as $key => $val)
                                                @if($direccion[$key]['Tipo_Direccion'] == "B")
                                                    <tr>
                                                        <td class="text-center"><a href="/ndiredit/{{$direccion[$key]['LineNum']}}"><i class="fas fa-pen"></i></a></td>
                                                        <td>{{$direccion[$key]['LineNum']}}</td>
                                                        <td>{{$direccion[$key]['Nombre_Direccion']}}</td>
                                                        <td>{{$direccion[$key]['Direccion_fisica']}}</td>
                                                        <td>{{$direccion[$key]['Departamento']}}</td>
                                                        <td>{{$direccion[$key]['Ciudad']}}</td>
                                                        <td>{{$direccion[$key]['Barrio_Vereda_Corregimiento']}}</td>
                                                        <td>{{$direccion[$key]['Codigo_Postal']}}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
    .dataTables_wrapper{
        color: #212529!important;
        font-weight: bold!important;
    }
    div.dataTables_wrapper div.dataTables_length label, div.dataTables_filter label {
        font-weight: bold!important;
    }
    div.dataTables_wrapper div.dataTables_length label select, div.dataTables_filter label input{
        color: white!important;
        background: #212529!important;
    }
    .paginate_button a{
        color: white !important;
        background-color: #212529!important;
    }
</style>
@endsection
@section('script')
<script>
    Toast.info(
    'Notification from the frontend...',
    'The Title'
    );
</script>
@endsection