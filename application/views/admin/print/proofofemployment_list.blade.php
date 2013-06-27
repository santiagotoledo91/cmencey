@layout('layouts.admin')
@section('content')
<div class="container-fluid">

	<div class="row-fluid">

		<div class="span12">

			@if (!empty($employees))

				<h4 class="text-center">Listado de empleados</h4>
				<div class="space1"></div>

				<table class="table table-hover white-area" style="font-size:11px;">

					<tr class="head well">

						<th>CARGO</th>
						<th>C.I</th>
						<th>NOMBRE</th>
						<th>TELÉFONO</th>
						<th>DIRECCIÓN</th>
						<th>INGRESO</th>
						<th>SALARIO</th>
						<th>ACTIVO</th>
						<th>ACCIONES</th>

					</tr>

				@foreach ($employees as $employee)

					<tr>

						<td>{{ $employee->role }} </td>
						<td>{{ $employee->pin }}</td>
						<td>{{ $employee->fullname }}</td>
						<td>{{ $employee->phone }}</td>
						<td>{{ $employee->address }}</td>
						<td>{{ $employee->startdate }}</td>
						<td>Bs. {{ $employee->salary }}</td>
						<td>{{ $employee->active }}</td>
						<td>{{ HTML::link('admin/print/proofofemployment/'.$employee->id,'Imprimir') }} </td>

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