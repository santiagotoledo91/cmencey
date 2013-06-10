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

<div class="deposits">
	
	<h4 class="centered"> Nómina #{{ $paysheet->id }} ({{ $paysheet->startdate}} al {{ $paysheet->stopdate }})</h4>
	<div class="space1"></div>
	
	<table style="font-size: 7px !important;">

		<tr >

			<th rowspan="2" style="width:1px;">C.I</th>
			<th rowspan="2" >NOMBRE</th>
			<th colspan="6">ASIGNACIONES</th>

			<th rowspan="2" style="width:50px;">TOTAL DEVENGADO</th>
			<th colspan="5">DEDUCCIONES</th>
			<th rowspan="2" style="width:50px;">TOTAL A PAGAR</th>

		</tr>

		<tr>
			<th style="width:45px;">SALARIO BASE SEMANAL</th>
			<th style="width:45px;">BONO DE ALIMENT.</th>
			<th style="width:45px;">HORAS EXTRA</th>
			<th style="width:45px;">BONO DE PROD.</th>
			<th style="width:45px;">PRIMAS EXT.</th>
			<th style="width:45px;">OTROS</th>
			<th style="width:45px;">SSO</th>
			<th style="width:45px;">PARO FORZOSO</th>
			<th style="width:45px;">FAOV</th>
			<th style="width:45px;">INCES</th>
			<th style="width:45px;">PRESTAMOS RECIBIDOS</th>
			
		</tr>

	@foreach ($paysheetpayments as $payment)

		<tr>

			<td style="margin-left:30px;"> 	{{ $payment->pin 				}}	</td>
			<td> 	{{ $payment->fullname			}}	</td>
			<td>Bs. {{ $payment->salary * 7 		}} 	</td>
			<td>Bs. {{ $payment->feeding_bonus 	}}	</td>
			<td>Bs. {{ $payment->extra_hours		}}	</td>
			<td>Bs. {{ $payment->production_bonus 	}}	</td>
			<td>Bs. {{ $payment->extra_raws 		}}	</td>
			<td>Bs. {{ $payment->others 			}}	</td>
			<td>Bs. {{ $payment->accrued_total 	}}	</td>
			<td>Bs. {{ $payment->sso 				}}	</td>
			<td>Bs. {{ $payment->forced_stop		}}	</td>
			<td>Bs. {{ $payment->faov 				}}	</td>
			<td>Bs. INCES	</td>
			<td>Bs. {{ $payment->received_loans 	}}	</td>
			<td>Bs. {{ $payment->net_total 		}}	</td>

		</tr>

	@endforeach

		<tr>
			<td colspan="15"><h4 style="text-align: center; margin-top:7px;">TOTAL = Bs. {{$paysheet->total}}</h4></td>
		</tr>

	</table>

</div>

{{ Form::close() }}

@foreach ($paysheetpayments as $payment)

		<div class="receipt">

		<div class="receipt-content">
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

	</div>

	<div class="receipt">

		<div class="receipt-content">
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

	</div>

@endforeach
@endsection