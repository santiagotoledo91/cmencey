@layout('layouts.print')
@section('content')
<div class="deposits">

	<div class="centered">
		{{HTML::image('img/logo.png','logo',array('width' => '170px'));}}
	</div>

	<h5 class="centered"> Listado de personal </h5>

	<table>

		<tr>

			<th>C.I</th>
			<th>NOMBRE</th>
			<th>CARGO</th> 

		</tr>

	@foreach ($employees as $employee)

		<tr>

			<td style="text-align: center">	{{ $employee->pin }} </td>
			<td> {{ $employee->fullname }} </td>
			<td> {{ $employee->role }} </td>

		</tr>

	@endforeach

	</table>

</div>
@endsection