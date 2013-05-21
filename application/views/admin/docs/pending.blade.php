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

			@foreach ($employees as $employee)

				<tr>

					<td>{{ $employee->pin }}</td>
					<td>{{ $employee->fullname }}</td>
					<td>{{ $employee->pending_document }} </td>
					<td>{{ HTML::link('admin/employees/edit/'.$employee->id,'Actualizar') }}</td>
					
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