@foreach ($paysheetpayments as $payment)

<div class="container span5 offset1">
	
	<h5 class="text-center"> RECIBO DE NOMINA DE PAGO</h5>
	
	<div class="row">
	
			<div class="receipt-header">
				
				<b>Trabajador:</b> {{ $payment->fullname }} 
				</br>
				<b>C.I:</b> {{ $payment->pin }} 
				</br>
				<b>Periodo de pago:</b> Desde: {{$paysheet->startdate}} Hasta: {{$paysheet->stopdate}}
			
			</div>
	
	</div>	

	<div class="row">

		<table class="table table-bordered table-print">
			
			<tr>
				<td colspan="2"><b>1. Conceptos salariales</b></td>
			</tr>
			
			<tr>
				<td>Salario base </td>
				<td>{{ $payment->weekly_salary }}</td>
			</tr>
			
			<tr>
				<td colspan="2"><b>Complementos salariales</b></td>
			</tr>
			
			<tr>
				<td>Bono de alimentacion</td>
				<td>Bs.{{ $payment->feeding_bonus }}</td>
			</tr>

			<tr>
				<td>Horas extra</td>
				<td>Bs.{{ $payment->extra_hours }}</td>
			</tr>
			
			<tr>
				<td>Bono por produccion</td>
				<td>Bs.{{ $payment->production_bonus }}</td>
			</tr>
			
			<tr>
				<td>Otros</td>
				<td>Bs.{{ $payment->others }}</td>
			</tr>	

			<tr>
				<td>Primas extraordinarias </td>
				<td>Bs.{{ $payment->extra_raws }}</td>
			</tr>	

			<tr>
				<td>Total devengado</td>
				<td>Bs.{{ $payment->accrued_total }}</td>
			</tr>	

			<tr>
				<td colspan="2"><b>2. Deducciones</b></td>
				
			</tr>	
			
			<tr>
				<td>S.S.O</td>
				<td>Bs.{{ $payment->sso }}</td>
			</tr>	

			<tr>
				<td>Paro Forzoso</td>
				<td>Bs.{{ $payment->forced_stop }}</td>
			</tr>
			
			<tr>
				<td>FAOV</td>
				<td>Bs.{{ $payment->faov }}</td>
			</tr>
			
			<tr>
				<td>Anticipos Recibidos</td>
				<td>Bs.{{ $payment->received_loans }}</td>
			</tr>

			<tr>
				<td><b>Total a pagar</b></td>
				<td>Bs.{{ $payment->net_total }}</td>
			</tr>

		</table>

	</div>

	<div class="row">

		<p>Firma y sello de la empresa: ___________________</p>
		<p>Recibi conforme: _____________________________</p>
		

	</div>

</div>

@endforeach