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

    <h1>TURNO DEL PACIENTE</h1>


      <div class="">

          <div class="">
      
              <div class="">
                <div class="">


                <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                      <tr class="table-info">
                      <th style="width:15%;">Nombre y Apellido</th>
                      <th style="width:15%;">Profesional a cargo</th>
                      <th style="width:10%;">Motivo de Consulta</th>
                      <th style="width:10%;">Especialidad</th>
                      <th style="width:20%;">Fecha</th>
                      <th style="width:10%;">Hora</th>

                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($turnos as $turno)
                          <tr>
                              
                              <td>{{ $turno->paciente?->user?->first_name .' '. $turno->paciente?->user?->last_name }}</td>
                              <td>{{ $turno->profesional?->first_name .' '. $turno->profesional?->last_name}}</td>
                              <td>{{ $turno->motivo_consulta ?? 'No se selecciono un motivo de consulta. ' }}</td>
                              <td>{{ $turno->especialidad?->especialidad ?? 'No se selecciono una especialidad. '}}</td>  
                              <td>{{ $turno->fecha }}</td>
                              <td>{{ $turno->hora }}</td>                     
                              
                              
                          
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