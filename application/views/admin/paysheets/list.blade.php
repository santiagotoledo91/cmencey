@layout('layouts.admin')
@section('content')
<div class="container-fluid">

	<div class="row-fluid">

		<div class="span12">

			@if (!empty($paysheets))

				<h4 class="text-center">Listado de nóminas</h4>

				<table class="table table-bordered table-hover table-centered">

					<tr class="head well">

						<th>N˚</th>
						<th>PERIODO</th>
						<th>TOTAL</th>
						<th>ACCIONES</th>
						
					</tr>

				@foreach ($paysheets as $paysheet)

					<tr>

						<td>{{ $paysheet->id }}</td>
						<td>Desde {{ $paysheet->startdate }} hasta {{ $paysheet->stopdate }}</td>
						<td>Bs. {{ $paysheet->total }}</td>
						<td>{{ HTML::link('admin/print/paysheet/'.$paysheet->id,'Imprimir',array('target' => '_blank')) }}</td>

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