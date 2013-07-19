@layout('layouts.admin')
@section('content')
<div class="container-fluid">

	<div class="row-fluid">

		<div class="span9">

			@if (!empty($paysheets))

				<h4 class="text-center">Últimas nóminas generadas</h4>

				<table class="table table-bordered table-hover table-centered" style="margin-top:19px;" >

					<tr>

						<th>N˚</th>
						<th>PERIODO</th>
						<th>TOTAL</th>
						<th>ACCIONES</th>

					</tr>

				@foreach ($paysheets as $paysheet)

					<tr>

						<td>{{ $paysheet->id }} </td>
						<td>Desde {{ $paysheet->startdate }} hasta {{ $paysheet->stopdate }}</td>
						<td>Bs. {{ $paysheet->total }}</td>
						<td>{{ HTML::link('admin/print/paysheet/'.$paysheet->id,'Imprimir',array('target' => '_blank')) }}</td>

					</tr>

				@endforeach	

				</table>

			@else

				<h4 class="text-center"> Aún no ha generado ninguna nómina</h4>
				<h4 class="text-center"> {{ HTML::link('admin/paysheets/pre','Generar nómina') }}</h4>

			@endif

		</div>

		<div class="span3">

			<h4 class="text-center"> Documentación </h4>
			<div class="space1"></div>
			<table class="table table-info table-hover pointer">

				@if ($pending != 0)
					<tr class="error-min-r" onclick="document.location = 'admin/docs/pending/' ">
						<td> Documentos por consignar: </td>
						<td>{{ $pending }}</td>
					</tr>
				@else
					<tr class="success-min-r">
						<td colspan="2"> No hay documentos por consignar. </td>
					</tr>
				@endif

				@if ($expired != 0)
					<tr class="error-min-r" onclick="document.location = 'admin/docs/expired/' ">
						<td> Documentos vencidos: </td>
						<td>{{ $expired }}</td>
					</tr>
				@else
					<tr class="success-min-r">
						<td colspan="2"> No hay documentos vencidos. </td>
					</tr>
				@endif
				
				@if ($close_to_expire != 0)
					<tr class="error-min-r" onclick="document.location = 'admin/docs/expired/' ">
						<td> Documentos por vencer: </td>
						<td>{{ $close_to_expire }}</td>
					</tr>
				@else
					<tr class="success-min-r">
						<td colspan="2"> No hay documentos por vencer. </td>
					</tr>
				@endif

			</table>

			<h4 class="text-center"> Información general </h4>
			<div class="space1"></div>

			<table class="table-info table-bordered table table-hover pointer">

				<tr onclick="document.location = 'admin/employees/manage'">
					<td> Trabajadores activos: </td>
					<td>{{ $employees }}</td>
				</tr>
				
				<tr onclick="document.location = 'admin/docs/manage'">
					<td> Tipos de documentos registrados: </td>
					<td>{{ $document_types }}</td>
				</tr>

			</table>

		</div>

	</div>

</div>
@endsection