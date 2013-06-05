@layout('layouts.admin')
@section('content')
<div class="container-fluid">

	<div class="row-fluid">

		<div class="span10 offset1">

			@if (!empty($paysheets))

				<legend class="text-center">Listado de nominas</legend>

				<table class="table table-bordered table-hover">

					<tr class="head well">

						<th>N˚</th>
						<th>DESDE</th>
						<th>HASTA</th>
						<th>TOTAL</th>
						<th>ACCIONES</th>
						
					</tr>

				@foreach ($paysheets as $paysheet)

					<tr>

						<td>{{ $paysheet->id }} </td>
						<td>{{ $paysheet->startdate }}</td>
						<td>{{ $paysheet->stopdate }}</td>
						<td>Bs. {{ $paysheet->total }}</td>
						<td>{{ HTML::link('admin/print/paysheet/'.$paysheet->id,'Imprimir') }}</td>

					</tr>

				@endforeach

				</table>

			@else

				<legend>Listado de nominas</legend>
				<h4 class="text-center"> Aun no ha generado ninguna nomina. {{ HTML::link('admin/paysheets/pre','Generar nomina.') }}</h4>
			
			@endif

		</div>

	</div>

</div>
@endsection