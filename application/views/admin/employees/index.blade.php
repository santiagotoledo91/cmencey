<table class="table table-striped">
	<tr class="head">
		<th>ID</th>
		<th>Cargo</th>
		<th>C.I</th>
		<th>Nombre</th>
		<th>Teléfono</th>
		<th>Dirección</th>
		<th>Salario</th>
		<th>Activo</th>
	</tr>

@foreach ($employees as $employee)
	<tr>
		<td>{{ $employee->id }} </td>
		<td>{{ $employee->description }} </td>
		<td>{{ $employee->pin }}</td>
		<td>{{ $employee->fullname }}</td>
		<td>{{ $employee->phone }}</td>
		<td>{{ $employee->address }}</td>
		<td>{{ $employee->salary }}</td>
		<td>{{ $employee->active }}</td>
	</tr>
@endforeach
</table>


