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

			@foreach ($pending_documents as $pending_document)

				<tr>

					<td>{{ $pending_document->pin }}</td>
					<td>{{ $pending_document->fullname }}</td>
					<td>{{ $pending_document->description }} </td>
					<td>{{ HTML::link('admin/','Actualizar') }}</td>
					
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