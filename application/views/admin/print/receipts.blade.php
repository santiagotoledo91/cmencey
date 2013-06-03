@layout('layouts.print')
@section('content')
@foreach ($paysheetpayments as $payment)

	<div class="receipt">

		<div class="receipt-header">
			
			
			<div class="centered">{{HTML::image('img/logo.png','logo',array('width' => '230px'));}}</div>
			<div class="space"></div>
			<h5 class="centered"> RECIBO DE NÓMINA DE PAGO</h5>		
			<div class="space"></div>
			
			<b>Trabajador:</b> {{ $payment->fullname }} 
			</br>
			<b>C.I:</b> {{ $payment->pin }} 
			</br>
			<b>Periodo de pago:</b> Desde: {{$paysheet->startdate}} Hasta: {{$paysheet->stopdate}}
			</br>
			<b>N˚ días/horas:</b> 7 

		</div>
		<div class="space"></div>	
		<table class="table-print">
			
			<tr>
				<th colspan="2"><b>1. Conceptos salariales</b></th>
			</tr>
			
			<tr>
				<td>Salario base </td>
				<td>Bs. {{ $payment->weekly_salary }}</td>
			</tr>
			
			<tr>
				<th colspan="2"><b>Complementos salariales</b></th>
			</tr>
			
			<tr>
				<td>Bono de alimentación</td>
				<td>Bs. {{ $payment->feeding_bonus }}</td>
			</tr>

			<tr>
				<td>Horas extra</td>
				<td>Bs. {{ $payment->extra_hours }}</td>
			</tr>
			
			<tr>
				<td>Bono por producción</td>
				<td>Bs. {{ $payment->production_bonus }}</td>
			</tr>
			
			<tr>
				<td>Otros</td>
				<td>Bs. {{ $payment->others }}</td>
			</tr>	

			<tr>
				<td>Primas extraordinarias </td>
				<td>Bs. {{ $payment->extra_raws }}</td>
			</tr>	

			<tr class="total">
				<td style="text-align: right;"><b>Total devengado</b></td>
				<td>Bs. {{ $payment->accrued_total }}</td>
			</tr>	

			<tr>
				<th colspan="2"><b>2. Deducciones</b></th>
				
			</tr>	
			
			<tr>
				<td>S.S.O</td>
				<td>Bs. {{ $payment->sso }}</td>
			</tr>	

			<tr>
				<td>Paro Forzoso</td>
				<td>Bs. {{ $payment->forced_stop }}</td>
			</tr>
			
			<tr>
				<td>FAOV</td>
				<td>Bs. {{ $payment->faov }}</td>
			</tr>
			
			<tr>
				<td>Prestamos Recibidos</td>
				<td>Bs. {{ $payment->received_loans }}</td>
			</tr>

			<tr class="total">
				<td style="text-align: right;"><b>Total a pagar</b></td>
				<td>Bs. {{ $payment->net_total }}</td>
			</tr>

		</table>

		<div class="receipt-signatures">
			
			<a>Firma y sello de la empresa</a>
			<a>Recibí conforme</a>
		</div>

		<div class="receipt-footer centered">
			construccionesmencey@yahoo.es
			Tel: 0414-589.36.59 / 0424-370.95.60
		</div>

	</div>

	<div class="receipt">

		<div class="receipt-header">
			
			
			<div class="centered">{{HTML::image('img/logo.png','logo',array('width' => '230px'));}}</div>
			<div class="space"></div>
			<h5 class="centered"> RECIBO DE NÓMINA DE PAGO</h5>		
			<div class="space"></div>
			
			<b>Trabajador:</b> {{ $payment->fullname }} 
			</br>
			<b>C.I:</b> {{ $payment->pin }} 
			</br>
			<b>Periodo de pago:</b> Desde: {{$paysheet->startdate}} Hasta: {{$paysheet->stopdate}}
			</br>
			<b>N˚ días/horas:</b> 7 

		</div>
		<div class="space"></div>	
		<table class="table-print">
			
			<tr>
				<th colspan="2"><b>1. Conceptos salariales</b></th>
			</tr>
			
			<tr>
				<td>Salario base </td>
				<td>Bs. {{ $payment->weekly_salary }}</td>
			</tr>
			
			<tr>
				<th colspan="2"><b>Complementos salariales</b></th>
			</tr>
			
			<tr>
				<td>Bono de alimentación</td>
				<td>Bs. {{ $payment->feeding_bonus }}</td>
			</tr>

			<tr>
				<td>Horas extra</td>
				<td>Bs. {{ $payment->extra_hours }}</td>
			</tr>
			
			<tr>
				<td>Bono por producción</td>
				<td>Bs. {{ $payment->production_bonus }}</td>
			</tr>
			
			<tr>
				<td>Otros</td>
				<td>Bs. {{ $payment->others }}</td>
			</tr>	

			<tr>
				<td>Primas extraordinarias </td>
				<td>Bs. {{ $payment->extra_raws }}</td>
			</tr>	

			<tr class="total">
				<td style="text-align: right;"><b>Total devengado</b></td>
				<td>Bs. {{ $payment->accrued_total }}</td>
			</tr>	

			<tr>
				<th colspan="2"><b>2. Deducciones</b></th>
				
			</tr>	
			
			<tr>
				<td>S.S.O</td>
				<td>Bs. {{ $payment->sso }}</td>
			</tr>	

			<tr>
				<td>Paro Forzoso</td>
				<td>Bs. {{ $payment->forced_stop }}</td>
			</tr>
			
			<tr>
				<td>FAOV</td>
				<td>Bs. {{ $payment->faov }}</td>
			</tr>
			
			<tr>
				<td>Prestamos Recibidos</td>
				<td>Bs. {{ $payment->received_loans }}</td>
			</tr>

			<tr class="total">
				<td style="text-align: right;"><b>Total a pagar</b></td>
				<td>Bs. {{ $payment->net_total }}</td>
			</tr>

		</table>

		<div class="receipt-signatures">
			
			<a>Firma y sello de la empresa</a>
			<a>Recibí conforme</a>
		</div>

		<div class="receipt-footer centered">
			construccionesmencey@yahoo.es
			Tel: 0414-589.36.59 / 0424-370.95.60
		</div>

	</div>

@endforeach
@endsection