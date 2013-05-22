<div class="container-fluid">

	<div class="row-fluid">

		<div class="span9">

			@if (!empty($documents))

				<legend> Listado {{ $subtitle }} </legend>

				<table class="table table-striped well">

					<tr class="head">

						<th>C.I</th>
						<th>Nombre del empleado</th>
						<th>Documento</th>
						<th>Fecha de vencimiento</th>
						<th>Acciones</th>
					</tr>

				@foreach ($documents as $document)

					<tr class=" {{ $document->class	}} ">

						<td>{{ $document->employee_pin }}</td>
						<td>{{ $document->employee_fullname }}</td>
						<td>{{ $document->description }} </td>
						<td>{{ $document->expiration }} </td>
						<td>{{ HTML::link('admin/employees/edit/'.$document->employee_id,'Actualizar') }}</td>
						
					</tr>

				@endforeach

				</table>

			@else

				<legend> Listado {{ $subtitle }} </legend>
				<h4 class="text-center"> No tiene documentos por vencidos o por vencer.</h4>

			@endif
		</div>

		<div class="span3">
		
			<div class="row-fluid">
					
				<legend>Ayuda</legend>
			
				informacion necesaria
			
			</div>

		</div>

</div>