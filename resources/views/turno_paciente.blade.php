<!DOCTYPE html>
<html>
<head>
    <title>Turno Médico</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
        .highlight-row {
            background-color: yellow; /* Cambia el color según tus necesidades */
        }
    </style>
</head>
<body>
    <h1>Turno Médico</h1>
    <table>
    @foreach ($turnos as $turno)
          <tr>
              <th >Paciente</th>
              <th>Profesional</th> 
          </tr>

          <tr>
            <td>{{ $turno->paciente?->user?->first_name .' '. $turno->paciente?->user?->last_name  }}</td>  
            <td>{{ $turno->profesional?->first_name .' '. $turno->profesional?->last_name }}</td>
          </tr>
          
          
          <tr>
            <th>Fecha</th>
            <th>Hora</th>
          </tr>

          <tr>
            <td>{{ $turno->fecha }}</td>  
            <td>{{ $turno->hora }}</td>
          </tr>


          <tr>
            <th>Motivo de Consulta</th>
            <th>Especialidad</th>
          </tr>


          <tr>
          <td>{{ $turno->motivo_consulta ?? 'No se selecciono un motivo de consulta. ' }}</td>  
          <td>{{ $turno->especialidad?->especialidad ?? 'No se selecciono una especialidad. ' }}</td>
          </tr>

          
        @endforeach  
    </table>
</body>
</html>
