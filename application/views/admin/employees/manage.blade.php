@layout('layouts.admin')
@section('content')
<div class="container-fluid">

	<div class="row-fluid">

		<div class="span9">

			@if (!empty($employees))
				
				<legend>Listado de empleados</legend>

				<table class="table table-bordered table-hover">

					<tr class="head well">

						<th>CARGO</th>
						<th>C.I</th>
						<th>NOMBRE</th>
						<th>TELÉFONO</th>
						<th>DIRECCIÓN</th>
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
						<td>Bs. {{ $employee->salary }}</td>
						<td>{{ $employee->active }}</td>
						<td>{{ HTML::link('admin/employees/edit/'.$employee->id,'Editar') }}</td>

					</tr>

				@endforeach

				</table>

			@else

				<legend>Listado de empleados</legend>
				<h4 class="text-center"> Aun no ha registrado ningun empleado. {{ HTML::link('admin/employees/add','Agregar un nuevo empleado.') }}</h4>

			@endif

		</div>

		<div class="span3">

			<div class="row-fluid">
	
				<legend>Ayuda</legend>

				informacion necesaria

			</div>

		</div>

	</div>

</div>
@endsection
