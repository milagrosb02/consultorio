ini_set('max_execution_time', 120);
@php
    use Carbon\Carbon;
@endphp
<html>
	<head>
		<meta charset="utf-8">
		<title>Turno</title>
		 <link rel="stylesheet" href="{{ asset('css/estilos.css')}}">
		<link rel="license" href="https://www.opensource.org/licenses/mit-license/">
		<script src="script.js"></script>
	</head>
	<body>
		<header>
			<h1>TURNO</h1>
            @foreach ($turnos as $turno)
			<address contenteditable>
				<p>PACIENTE: {{ $turno->paciente?->user?->first_name .' '. $turno->paciente?->user?->last_name  }}</p>
                <p>{{ \Carbon\Carbon::now() }}</p>
			</address>
			<span><img alt="" src="http://www.jonathantneal.com/examples/invoice/logo.png"><input type="file" accept="image/*"></span>
		</header>
		<article>
			<h1>Detalles del Turno</h1>
			<table class="meta">
				<tr>
					<th><span contenteditable>FECHA DEL TURNO</span></th>
					<td><span contenteditable>{{ $turno->fecha }}</span></td>
				</tr>
				<tr>
					<th><span contenteditable>HORA DEL TURNO</span></th>
					<td><span contenteditable>{{ $turno->hora}}</span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>

						<th><span contenteditable>PROFESIONAL</span></th>
						<th><span contenteditable>MOTIVO DE CONSULTA</span></th>
						<th><span contenteditable>ESPECIALIDAD</span></th>
						
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><a class="cut">-</a><span contenteditable>{{ $turno->profesional?->first_name .' '. $turno->profesional?->last_name }}</span></td>
						<td><span contenteditable>{{ $turno->motivo_consulta ?? 'No se selecciono un motivo de consulta. ' }}</span></td>
						<td><span contenteditable>{{ $turno->especialidad?->especialidad ?? 'No se selecciono una especialidad. ' }}</span></td>
					</tr>
				</tbody>
			</table>
			
			
		</article>
        @endforeach  
	</body>
</html>