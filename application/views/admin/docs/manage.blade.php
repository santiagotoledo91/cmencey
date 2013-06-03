@layout('layouts.admin')
@section('content')
<div class="container-fluid">
	
	<div class="row-fluid">
	
		<div class="span9">
	
			@if (!empty($document_types))

				<legend> Listado de documentos requeridos </legend>
		
				<table class="table table-bordered table-hover">
		
					<tr class="head well">
		
						<th>DESCRIPCCIÓN DEL DOCUMENTO</th>
						<th>CONTROL DE VENCIMIENTO</th>
						<th>ACCIONES</th>
		
					</tr>

				@foreach ($document_types as $document_type)
		
					<tr>
		
						<td>{{ $document_type->description }}</td>
						
						@if ($document_type->expires == 1)
						
							<td> Si </td>
						
						@else
						
							<td> No </td>
						
						@endif
						
						<td>{{ HTML::link('admin/docs/edit/'.$document_type->id,'Editar') }}</td>
		
					</tr>
		
				@endforeach
		
				</table>
		
			@else
				
				<legend> Listado de documentos requeridos</legend>
				<h4 class="text-center"> Aun no ha registrado ningun tipo de documento. {{ HTML::link('admin/docs/add','Agregar un nuevo tipo.') }} </h4>
			
			@endif
	
		</div>
	
		<div class="span3">
	
			<div class="row-fluid">
					
				<legend>Ayuda</legend>
			
				informacion necesaria
			
			</div>

		</div>
	
	</div>

</div>
@endsection