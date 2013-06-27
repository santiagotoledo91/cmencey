@layout('layouts.admin')
@section('content')
<div class="container-fluid">

	<div class="row-fluid">

		<div class="span12">

			@if (!empty($socialbeneficts))

				<h4 class="text-center">Listado de liquidaciones</h4>

				<table class="table table-bordered table-hover table-centered">

					<tr class="head well">

						<th>CÉDULA</th>
						<th>NOMBRE COMPLETO</th>
						<th>PERIODO</th>
						<th>RAZÓN</th>
						<th>TOTAL</th>
						<th>ACCIONES</th>
						
					</tr>

				@foreach ($socialbeneficts as $socialbenefict)

					<tr>

						<td>{{ $socialbenefict->pin }}</td>
						<td>{{ $socialbenefict->fullname }}</td>
						<td>Desde {{ $socialbenefict->startdate }} hasta {{ $socialbenefict->stopdate }}</td>
						<td>{{ $socialbenefict->reason }}</td>
						<td>Bs. {{ $socialbenefict->total }}</td>
						<td>{{ HTML::link('admin/print/socialbeneficts/'.$socialbenefict->id,'Imprimir',array('target' => '_blank')) }}</td>

					</tr>

				@endforeach

				</table>

			@else

				<h4 class="text-center"> Aun no ha generado ninguna nomina</h4>
				<h4 class="text-center"> {{ HTML::link('admin/socialbeneficts/pre','Generar nomina') }}</h4>
			
			@endif

		</div>

	</div>

</div>
@endsection