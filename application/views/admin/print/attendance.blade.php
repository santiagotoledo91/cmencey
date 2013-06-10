@layout('layouts.print')
@section('content')
<div class="deposits">

	<div class="centered">
		{{HTML::image('img/logo.png','logo',array('width' => '170px'));}}
	</div>
	<div style="margin-top:15px;"></div>
	
	<h5 class="centered"> Control de asistencia </h5>
	<h5 class="centered"> Del __________ al __________ </h5>
	<table>

		<tr>

			<th rowspan="2">C.I</th>
			<th rowspan="2">NOMBRE</th>
			<th colspan="2">LUNES</th> 
			<th colspan="2">MARTES</th>
			<th colspan="2">MIERCOLES</th>
			<th colspan="2">JUEVES</th>
			<th colspan="2">VIERNES</th>

		</tr>

		<tr>
			<th>Entrada</th> <th>Salida</th>
			<th>Entrada</th> <th>Salida</th>
			<th>Entrada</th> <th>Salida</th>
			<th>Entrada</th> <th>Salida</th>
			<th>Entrada</th> <th>Salida</th>
		</tr>
	@foreach ($employees as $employee)

		<tr>

			<td style="text-align: center">	{{ $employee->pin }} </td>
			<td> {{ $employee->fullname }} </td>
			<td style="width: 40px;"></td> <td style="width: 40px;"></td>
			<td style="width: 40px;"></td> <td style="width: 40px;"></td>
			<td style="width: 40px;"></td> <td style="width: 40px;"></td>
			<td style="width: 40px;"></td> <td style="width: 40px;"></td>
			<td style="width: 40px;"></td> <td style="width: 40px;"></td>

		</tr>

	@endforeach

	</table>

</div>
@endsection