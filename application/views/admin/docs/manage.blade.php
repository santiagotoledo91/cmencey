<div class="container-fluid">
	
	<div class="row-fluid">
	
		<div class="span9">
	
			<legend> Listado de documentos disponibles </legend>
	
			<table class="table table-striped well">
	
				<tr class="head">
	
					<th>Nombre</th>
					<th>Duracion</th>
					<th>Acciones</th>
	
				</tr>

			@foreach ($document_types as $document_type)
	
				<tr>
	
					<td>{{ $document_type->description }}</td>
					<td>{{ $document_type->expires_in }}</td>
					<td>{{ HTML::link('admin/docs/edit','Editar') }} - {{ HTML::link('admin/docs/delete','Eliminar') }} </td>
	
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

</div>