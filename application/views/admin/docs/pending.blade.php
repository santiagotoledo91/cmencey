<div class="container-fluid">

	<div class="row-fluid">

		<div class="span9">

			@if (!empty($documents))

				<legend> Listado {{ $subtitle }} </legend>

				<table class="table table-bordered table-hover">

					<tr class="head well">

						<th>C.I</th>
						<th>NOMBRE DEL EMPLEADO</th>
						<th>DOCUMENTO</th>
						<th>ACCIONES</th>
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
			
			@else
				
				<legend> Listado {{ $subtitle }} </legend>
				<h4 class="text-center"> No tiene documentos por consignar.</h4>

			@endif

		</div>

		<div class="span3">
		
			<div class="row-fluid">
					
				<legend>Ayuda</legend>
			
				informacion necesaria
			
			</div>

		</div>

</div>