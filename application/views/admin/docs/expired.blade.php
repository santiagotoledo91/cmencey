@layout('layouts.admin')
@section('content')
<div class="container-fluid">

	<div class="row-fluid">

		<div class="span12">

			@if (!empty($documents))

				<h4 class="text-center"> Documentos vencidos y por vencer </h4>
				<div class="space1"></div>

				<table class="table table-hover table-documents white-area">

					<tr class="head well">

						<th>C.I</th>
						<th>NOMBRE DEL EMPLEADO</th>
						<th>DOCUMENTO</th>
						<th>FECHA DE VENCIMIENTO</th>
						<th>ACCIONES</th>
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

				<h4 class="text-center"> No tiene documentos por vencidos o por vencer.</h4>

			@endif

		</div>

	</div>

</div>
@endsection