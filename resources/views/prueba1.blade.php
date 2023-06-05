<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Reporte de Paciente</title>
  </head>
  <body>

    <h1>HISTORIAL CLÍNICO</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">Nro de Ficha</th>
            <th scope="col">Nombre y Apellido</th>
            <th scope="col">Fecha</th>
            <th scope="col">Obra Social</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Profesional a cargo</th>
            <th scope="col">Motivo de Consulta</th>
            <th scope="col">Tratamientos Realizados</th>
            <th scope="col">Descripcion</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($legajos as $legajo)
                <tr>
                <th scope="col">{{ $legajo->id }}</th>
                <!-- <td>{{ $legajo->user->first_name .' '. $legajo->user->last_name }}</td> -->
                <td>{{ $legajo->fecha }}</td>
                <!-- <td>{{ $legajo->paciente->obra_social}}</td>
                <td>{{ $legajo->paciente->telefono }}</td> -->
                <!-- <td>{{ $legajo->turno->user_id }}</td> -->
                <td>{{ $legajo->tratamiento_id }}</td>
                <!-- <td>{{ $legajo->turno->user_id }}</td> -->
                </tr>
            @endforeach    

           
        </tbody>
    </table>


    
  </body>
</html>