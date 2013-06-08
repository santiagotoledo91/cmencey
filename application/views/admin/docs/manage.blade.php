@layout('layouts.admin')
@section('content')
<div class="container-fluid">
	
	<div class="row-fluid">
	
		<div class="span12">
	
			@if (!empty($document_types))

				<h4 class="text-center"> Documentos requeridos </h4>
				<div class="space1"></div>

				<table class="table white-area table-hover">
		
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
				
				<h4 class="text-center"> Aun no ha agregado ningun tipo de documento. </h4>
				<h4 class="text-center"> {{ HTML::link('admin/docs/add','Agregar nuevo tipo') }} </h4>
			
			@endif
	
		</div>
	
	</div>

</div>
@endsection