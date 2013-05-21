<div class="container-fluid">

	<div class="row-fluid">

		<div class="span9">
			
			<legend> Listado {{ $subtitle }} </legend>

			<table class="table table-striped well">

				<tr class="head">

					<th>C.I</th>
					<th>Nombre del empleado</th>
					<th>Documento</th>
					<th>Fecha de vencimiento</th>
					<th>Acciones</th>
				</tr>

			@foreach ($expired_documents as $expired_document)

				<tr class=" {{ $expired_document->class	}} ">

					<td>{{ $expired_document->pin }}</td>
					<td>{{ $expired_document->fullname }}</td>
					<td>{{ $expired_document->description }} </td>
					<td>{{ $expired_document->expiration }} </td>
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