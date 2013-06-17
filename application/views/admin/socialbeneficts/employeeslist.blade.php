@layout('layouts.admin')
@section('content')
<div class="container-fluid">

	<div class="row-fluid">

		<div class="span12">

			@if (!empty($employees))

				<h4 class="text-center">Listado de empleados</h4>
				<div class="space1"></div>

				<table class="table table-hover white-area">

					<tr class="head well">

						<th>CARGO</th>
						<th>C.I</th>
						<th>NOMBRE</th>
						<th>INGRESO</th>
						<th>ACCIONES</th>

					</tr>

				@foreach ($employees as $employee)

					<tr>

						<td>{{ $employee->role }} </td>
						<td>{{ $employee->pin }}</td>
						<td>{{ $employee->fullname }}</td>
						<td>{{ $employee->startdate }}</td>
						<td>{{ HTML::link('admin/socialbeneficts/pre/'.$employee->id,'Liquidar') }} </td>

					</tr>

				@endforeach

				</table>

			@else

				<h4 class="text-center"> Aun no ha registrado ningun empleado </h4>
				<h4 class="text-center"> {{ HTML::link('admin/employees/add','Agregar un nuevo empleado') }}</h4>

			@endif

		</div>

	</div>

</div>
@endsection