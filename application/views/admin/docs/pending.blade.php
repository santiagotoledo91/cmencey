<div class="container-fluid">

	<div class="row-fluid">

		<div class="span9">

			<legend> Listado {{ $subtitle }} </legend>

			<table class="table table-striped well">

				<tr class="head">

					<th>C.I</th>
					<th>Nombre del empleado</th>
					<th>Documento</th>
					<th>Acciones</th>
				</tr>

			@foreach ($documents as $document)

				<tr>

					<td>{{ $document->employee_pin }}</td>
					<td>{{ $document->employee_fullname }}</td>
					<td>{{ $document->description }} </td>
					<td>{{ HTML::link('admin/employees/edit/'.$document->employee_id,'Actualizar') }}</td>
					
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