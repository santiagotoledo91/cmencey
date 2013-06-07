@layout('layouts.admin')
@section('content')
<div class="container-fluid">

	<div class="row-fluid">

		<div class="span12">

			@if (!empty($paysheets))

				<h4 class="text-center">Listado de nominas</h4>
				<hr>

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

				<h4 class="text-center"> Aun no ha generado ninguna nomina</h4>
				<h4 class="text-center"> {{ HTML::link('admin/paysheets/pre','Generar nomina') }}</h4>
			
			@endif

		</div>

	</div>

</div>
@endsection