@layout('layouts.admin')
@section('content')
<div class="container-fluid">

	<div class="row-fluid">

		<div class="span9">

			@if (!empty($paysheets))

				<h4 class="text-center">Ultimas nominas generadas</h4>

				<table class="table table-bordered table-hover" style="margin-top:19px;">

					<tr class="head well">

						<th>N˚</th>
						<th>FECHA</th>
						<th>TOTAL</th>
						<th>ACCIONES</th>

					</tr>

				@foreach ($paysheets as $paysheet)

					<tr>

						<td>{{ $paysheet->id }} </td>
						<td>Desde {{ $paysheet->startdate }} hasta {{ $paysheet->stopdate }}</td>
						<td>Bs. {{ $paysheet->total }}</td>
						<td>{{ HTML::link('admin/print/paysheet/'.$paysheet->id,'Imprimir') }}</td>

					</tr>

				@endforeach

				</table>

			@else

				<h4 class="text-center"> Aun no ha generado ninguna nomina</h4>
				<h4 class="text-center"> {{ HTML::link('admin/paysheets/pre','Generar nomina') }}</h4>

			@endif

		</div>

		<div class="span3">

			<h4 class="text-center"> Documentacion </h4>
			<div class="space1"></div>
			<table class="table table-info table-hover">

				@if ($pending != 0)
					<tr class="error">
						<td> Documentos por consignar: </td>
						<td>{{ $pending }}</td>
					</tr>
				@else
					<tr class="success">
						<td colspan="2"> No hay documentos por consignar. </td>
					</tr>
				@endif

				@if ($expired != 0)
					<tr class="error">
						<td> Documentos vencidos: </td>
						<td>{{ $expired }}</td>
					</tr>
				@else
					<tr class="success">
						<td colspan="2"> No hay documentos vencidos. </td>
					</tr>
				@endif
				
				@if ($close_to_expire != 0)
					<tr class="error">
						<td> Documentos por vencer: </td>
						<td>{{ $expired }}</td>
					</tr>
				@else
					<tr class="success">
						<td colspan="2"> No hay documentos por vencer. </td>
					</tr>
				@endif

			</table>

			<h4 class="text-center"> Informacion general </h4>
			<div class="space1"></div>

			<table class="table-info table-bordered table ">

				<tr>
					<td> Trabajadores activos: </td>
					<td>{{ $employees }}</td>
				</tr>
				
				<tr>
					<td> Tipos de documentos registrados: </td>
					<td>{{ $document_types }}</td>
				</tr>

			</table>

		</div>

	</div>

</div>
@endsection