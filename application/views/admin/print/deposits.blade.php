<legend> Totales a depositar - Nomina #{{ $paysheet->id }} ({{ $paysheet->startdate}} al {{ $paysheet->stopdate }})  </legend>

<table class="table table-bordered table-hover" style="font-size: 12px">

	<tr class="head well">

		<th>C.I DEL TITULAR</th>
		<th>NOMBRE DEL TITULAR</th>
		<th>CUENTA CLIENTE NUMERO</th>
		<th>TOTAL A PAGAR</th>
		<th>DEPOSITADO</th>

	</tr>

@foreach ($paysheetpayments as $payment)

	<tr>

		<td> 	{{ $payment->pin 				}}	</td>
		<td> 	{{ $payment->fullname			}}	</td>
		<td>	{{ $payment->bank_account		}}	</td>
		<td>Bs. {{ $payment->net_total 			}}	</td>
		<td></td>
	</tr>

@endforeach

</table>

<h4 class="text-right"> TOTAL NOMINA: Bs. {{ $paysheet->total }} </h4>