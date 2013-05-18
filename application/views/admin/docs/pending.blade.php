<div class="container-fluid">

	<div class="row-fluid">

		<div class="span9">
			
			<legend> Listado de documentos pendientes </legend>

			<table class="table table-striped well">

				<tr class="head">

					<th>C.I</th>
					<th>Nombre del empleado</th>
					<th>Documento</th>
					<th>Vence</th>
					<th>Expedicion</th>
					<th>Procesar</th>

				</tr>

			@foreach ($pendings as $pending)

				<tr>

					<td>{{ $pending->pin }}</td>
					<td>{{ $pending->fullname }}</td>
					<td>{{ $pending->description }} </td>
					<td>{{ $pending->expires }}</td>
					<td>{{ Form::text('expedition') }}</td>
					<td>procesar</td>
					
				</tr>

			@endforeach

			</table>

		</div>

		<div class="span3">
		
			<div class="row-fluid">
					
				<legend>Ayuda</legend>
			
				informacion necesaria
			
			</div>

		</div>

</div>