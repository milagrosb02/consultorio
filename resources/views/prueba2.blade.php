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

    <strong>NOMBRE Y APELLIDO: </strong><span>{{ $legajo->paciente?->user?->first_name .' '. $legajo->paciente?->user?->last_name }}</span><br>
    <strong>OBRA SOCIAL: </strong><span>{{ $legajo->paciente?->obra_social?->obra_social}}</span>  <br>
    <strong>TELEFONO: </strong><span>{{ $legajo->paciente?->phone }}</span>


      <div class="">

          <div class="">
      
              <div class="">
                <div class="">


                <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                      <tr class="table-info">
                      <th style="width:5%;">Nro de Ficha</th>
                      <th style="width:10%;">Fecha</th>
                      <th style="width:15%;">Profesional a cargo</th>
                      <th style="width:20%;">Tratamientos Realizados</th>
                      <th style="width:10%;">Descripcion</th>

                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($legajos as $legajo)
                          <tr>
                          <th scope="col">{{ $legajo->id }}</th>
                              
                              
                              <td>{{ $legajo->fecha->format('d-m-Y') }}</td>
                                                   
                              <td>{{ $legajo->profesional?->first_name .' '. $legajo->profesional?->last_name}}</td>
                              

                              <td>
                              
                                {{ $legajo->tratamiento->nombre ?? 'No se realizo un tratamiento. '}}
                              
                              </td>
                                
                              <td> {{$legajo->descripcion}}</td>    
                          
                          </tr>
                      @endforeach    

                    
                  </tbody>
              </table>
                </div>

                


                </div>
                
            </div>
          </div>
       </div>


    


    
  </body>
</html>