<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        
    <style>
        .tittle {
            text-align: center;
        }
        body {
                font-family: 'Nunito', sans-serif;
                background-image: url("{{url('/')}}/img/fondologin.jpg");
                width: 100%;
                height: 100%;
                background-attachment: fixed;
            }
            .container {
                background-image: url("https://pagos.ivanagro.com/images/fondo.jpg");
                border: 1px solid black;
                border-radius: 10px;
                padding-left: 10px;
                padding-right: 10px;
            }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="tittle">Aceptado tratamiento de datos</h1>
        <div class="tittle">
            <img src="https://pagos.ivanagro.com/images/logo-ivanagro.png" width="130rem" alt="Logo IVANagro">
        </div>
        <br>
        <hr>
        <h3 class="text-center">Información personal</h3>
        <hr>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><b>Numero Identificación:</b> {{$user['FederalTaxID']}}</li>
            <li class="list-group-item"><b>Nombre:</b> {{$user['CardName']}}</li>
            <li class="list-group-item"><b>Telefonos:</b> {{$user['Phone1']}}; {{$user['Phone2']}}</li>
            <li class="list-group-item"><b>Correo de facturación electronica:</b> {{$user['EmailAddress']}}</li>
            <li class="list-group-item"><b>Correos de comerciales:</b> {{$user['Website']}}</li>
            <li class="list-group-item"><b>Comentarios:</b> {{$user['FreeText']}}</li>
        </ul>
        
        <br>
        <hr>
        <h3 class="text-center">Direcciones</h3>
        <hr>
    
        @foreach ($direcciones as $key => $dir)
        <strong>Dirección {{$key+1}}</strong>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Nombre de la dirección:</b> {{$dir['AddressName']}}</li>
                <li class="list-group-item"><b>Departamento:</b> {{$dir['County']}}</li>
                <li class="list-group-item"><b>Ciudad:</b> {{$dir['City']}}; </li>
                <li class="list-group-item"><b>Barrio/vereda/corregimiento:</b> {{$dir['Block']}}</li>
                <li class="list-group-item"><b>Codigo postal:</b> {{$dir['ZipCode']}}</li>
                <li class="list-group-item"><b>Direccion fisica:</b> {{$dir['Street']}}</li>
            </ul>
        @endforeach
    
    
        
        <br>
        <hr>
        <h3 class="text-center">Contactos</h3>
        <hr>
    
        @foreach ($contactos as $key => $con)
        <strong>Contacto {{$key+1}}</strong>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Tipo de contacto:</b> {{$con['Name']}}</li>
                <li class="list-group-item"><b>Nombre Completo:</b> {{$con['FirstName']}} {{$con['MiddleName']}} {{$con['LastName']}}</li>
                <li class="list-group-item"><b>Telefonos:</b> {{$con['Phone1']}}; {{$con['Phone2']}}</li>
                <li class="list-group-item"><b>Celular:</b> {{$con['MobilePhone']}} </li>
                <li class="list-group-item"><b>Correo de contacto:</b> {{$con['E_Mail']}}</li>
                <li class="list-group-item"><b>Profesión:</b> {{$con['Profession']}}</li>
            </ul>
        @endforeach
        
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
           
</body>
</html>