@layout('layouts.print')
@section('content')
<div class="deposits">
	
	<div class="centered">
		{{HTML::image('img/logo.png','logo',array('width' => '170px'));}}
	</div>
	
	<h5 class="centered"> Totales a depositar - Nomina #{{ $paysheet->id }} ({{ $paysheet->startdate}} al {{ $paysheet->stopdate }})  </h5>

	<table>

		<tr>

			<th>CUENTA CLIENTE NUMERO</th>
			<th>C.I DEL TITULAR</th>
			<th>NOMBRE DEL TITULAR</th>
			<th>TOTAL A PAGAR</th>
			<th>OK</th>

		</tr>

	@foreach ($paysheetpayments as $payment)

		<tr>

			<td>	{{ $payment->bank_account		}}	</td>
			<td>  V-{{ $payment->pin 				}}	</td>
			<td>  	{{ $payment->fullname			}}	</td>
			<td>Bs. {{ $payment->net_total 			}}	</td>
			<td style="padding-left: 8px">☐</td>
		</tr>

	@endforeach
		
		<tr>
			<th colspan="3">TOTAL NÓMINA</th>
			<th colspan="2">Bs. {{ $paysheet->total }}</th>

		</tr>

	</table>

</div>
@endsection