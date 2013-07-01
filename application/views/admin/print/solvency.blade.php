@layout('layouts.print')
@section('content')
<div class="deposits">

	<div class="centered">
		{{HTML::image('img/logo.png','logo',array('width' => '170px'));}}
	</div>

	<h5 class="centered"> Deducciones por concepto de {{ $solvency->concept }} ({{ $solvency->startdate }} al {{ $solvency->stopdate }}) </h5>

	<table>

		<tr>

			<th>C.I</th>
			<th>NOMBRE</th>
			<th>TOTAL DEDUCIDO (Bs.)</th> 

		</tr>

	@foreach ($solvency->payments as $payment)

		<tr>

			<td style="text-align: center">	{{ $payment->pin }} </td>
			<td> {{ $payment->fullname }} </td>
			<td> {{ round($payment->total,2) }} </td>

		</tr>

	@endforeach

	</table>

</div>
@endsection