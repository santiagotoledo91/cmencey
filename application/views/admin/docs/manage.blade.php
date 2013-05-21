<div class="container-fluid">
	
	<div class="row-fluid">
	
		<div class="span9">
	
			<legend> Listado de documentos requeridos </legend>
	
			<table class="table table-striped well">
	
				<tr class="head">
	
					<th>Descripción del documento</th>
					<th>Acciones</th>
	
				</tr>

			@foreach ($document_types as $document_type)
	
				<tr>
	
					<td>{{ $document_type->description }}</td>
					<td>{{ HTML::link('admin/docs/edit/'.$document_type->id,'Editar') }} - {{ HTML::link('admin/docs/delete','Eliminar') }} </td>
	
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