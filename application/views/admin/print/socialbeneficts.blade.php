@layout('layouts.print')
@section('content')

	<div class="receipt-socialbeneficts">

		<div class="centered">
			{{HTML::image('img/logo.png','logo',array('width' => '170px'));}}
		</div>

		<div class="space1"></div>

		<table style="font-size:9px; text-align: center">
			
			<tr>
				<td colspan="4" style="text-align:center"> <strong>DATOS DEL TRABAJADOR</strong> </td>
			</tr>
			
			<tr>
				<td colspan="2"><strong>NOMBRES Y APELLIDOS</strong></td>
				<td><strong>CÉDULA DE IDENTIDAD</strong> </td>
				<td><strong>CARGO</strong></td>
			</tr>

			<tr>
				<td colspan="2">{{ $payment->fullname }}</td>
				<td>V-{{ $payment->pin}}</td>
				<td>{{$payment->role}}</td>
			</tr>

			<tr>
				<td colspan="4"><strong>DIRECCIÓN</strong></td>
			</tr>

			<tr>
				<td colspan="4">{{$payment->address}} </td>
			</tr>

			<tr>
				<td style="width:25%;"><strong>TIPO DE LIQUIDACIÓN</strong> </td>
				<td style="width:25%;"><strong>FECHA DE INGRESO</strong></td>
				<td style="width:25%;"><strong>FECHA DE EGRESO</strong></td>
				<td style="width:25%;"><strong>TIEMPO DE SERVICIO</strong></td>
			</tr>

			<tr>
				<td>{{$payment->reason}} </td>
				<td>{{$payment->startdate}} </td>
				<td>{{$payment->stopdate}} </td>
				<td>{{$payment->servicetime}} </td>
			</tr>
			
			<tr>
				<td colspan="2"><strong>SALARIO BÁSICO MENSUAL (Bs.)</strong></td>
				<td colspan="2"><strong>SALARIO BÁSICO DIARIO (Bs.)</strong></td>
			</tr>

			<tr>
				<td colspan="2">{{$payment->salary * 30}} </td>
				<td colspan="2">{{$payment->salary}}</td>
			</tr>

		</table>

		<table style="font-size:9px; text-align: center">

			<tr>
				<td colspan="4"><strong>ASIGNACIONES</strong></td>
			</tr>

			<tr>
				<td><strong>CONCEPTOS</strong></td>
				<td><strong>DÍAS</strong></td>
				<td><strong>SALARIO BASE CALCULADO</strong></td>
				<td style="width:20%;"><strong>MONTO Bs.</strong></td>
			</tr>	

			<tr>
				<td style="text-align:left;">ANTIGUEDAD CLAUSULA 46 C.C.C</td>
				<td>{{$payment->antiquity_days}}</td>
				<td>{{$payment->salary}}</td>
				<td>{{$payment->antiquity_total}}</td>
			</tr>

			<tr>
				<td style="text-align:left;">UTILIDADES CLAUSULA 44 C.C.C</td>
				<td>{{$payment->utilities_days}}</td>
				<td>{{$payment->salary}}</td>
				<td>{{$payment->utilities_total}}</td>
			</tr>

			<tr>
				<td style="text-align:left;">VACACIONES CLAUSULA 43 C.C.C</td>
				<td rowspan="4">{{$payment->vacations_days}}</td>
				<td rowspan="4">{{$payment->salary}}</td>
				<td rowspan="4">{{$payment->vacations_total}}</td>

			</tr>
			
			<tr>
				<td style="text-align:left;">BONO VACACIONAL CLAUSULA 43 C.C.C</td>
			</tr>
			
			<tr>
				<td style="text-align:left;">VACACIONES FRACCIONADAS CLAUSULA 43 C.C.C</td>
			</tr>

			<tr>
				<td style="text-align:left;">BONO VACACIONAL FRACCIONADO CLAUSULA 43 C.C.C</td>
			</tr>

			<tr>
				<td style="text-align:left;">SALARIOS CAIDOS</td>
				<td>{{$payment->down_salaries_days}}</td>
				<td>{{$payment->salary}}</td>
				<td>{{$payment->down_salaries_total}}</td>
			</tr>

			<tr>
				<td colspan="3" style="text-align:right;"><strong>TOTAL ASIGNACIONES</strong></td>
				<td>{{$payment->assignments_total}}</td>
			</tr>

			<tr>
				<td colspan="4"><strong>DEDUCCIONES</strong></td>
			</tr>

			<tr>
				<td colspan="3"><strong>CONCEPTOS</strong></td>
				<td><strong>MONTO Bs.</strong></td>
			</tr>

			<tr>
				<td colspan="3" style="text-align:left;">ANTICIPOS RECIBIDOS</td>
				<td>{{$payment->received_advances}}</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align:left;">PRÉSTAMOS</td>
				<td>{{$payment->received_loans}}</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align:left;">OTROS</td>
				<td>{{$payment->others}}</td>
			</tr>

			<tr>
				<td colspan="3" style="text-align:right;"><strong>TOTAL DEDUCCIONES</strong></td>
				<td>{{$payment->deductions_total}}</td>
			</tr>
		
			<tr>
				<td colspan="3" style="text-align:right;"><strong>TOTAL LIQUIDACIÓN DE PRESTACIONES SOCIALES</strong></td>
				<td>{{$payment->total}}</td>
			</tr>

			<tr>
				<td colspan="4" style="text-align:justify;"> SON Bs. {{$payment->total}}, CANTIDAD QUE RECIBO Y ACEPTO EN ESTA MISMA FECHA, EN DINERO EFECTIVO Y A SATISFACCIÓN, MEDIANTE CHEQUE N˚ {{ $payment->check }} DEL BANCO DE VENEZUELA, HACIENDO CONSTAR QUE NO TENGO NADA QUE RECLAMAR SOBRE LO ARRIBA INDICADO.</td>
			</tr>	
		
		</table>
		
		<div class="space1"></div>

		<table style="font-size:9px; text-align: center">

			<tr>
				<td colspan="4"><strong>FIRMAS</strong></td>
			</tr>

			<tr>
				<td colspan="2" style="width:50%;"><strong>GERENCIA GENERAL</strong></td>
				<td colspan="2" rowspan="2"><strong>TRABAJADOR</strong></td>
			</tr>

			<tr>
				<td><strong>ELABORADO POR</strong></td>
				<td><strong>REVISADO POR</strong></td>
		    </tr>

			<tr>
				<td style="height:90px; width:25%;"></td>
				<td style="height:90px;"></td>
				<td colspan="2" style="height:90px;"></td>
			</tr>

			<tr>
				<td>ADMINISTRACIÓN</td>
				<td>GERENCIA GENERAL</td>
				<td>{{$payment->fullname}} - C.I: {{$payment->pin}} </td>
			</tr>

			<tr>
				<td colspan="2"><strong>FECHA:</strong> {{ date('d-m-Y',strtotime($payment->createdate)) }} </td>
				<td colspan="2"><strong>FECHA: __-__-____</strong></td>
			</tr>	

		</table>

	</div>

	<div class="receipt-socialbeneficts">

		<div class="centered">
			{{HTML::image('img/logo.png','logo',array('width' => '170px'));}}
		</div>

		<div class="space1"></div>

		<table style="font-size:9px; text-align: center">
			
			<tr>
				<td colspan="4" style="text-align:center"> <strong>DATOS DEL TRABAJADOR</strong> </td>
			</tr>
			
			<tr>
				<td colspan="2"><strong>NOMBRES Y APELLIDOS</strong></td>
				<td><strong>CÉDULA DE IDENTIDAD</strong> </td>
				<td><strong>CARGO</strong></td>
			</tr>

			<tr>
				<td colspan="2">{{ $payment->fullname }}</td>
				<td>V-{{ $payment->pin}}</td>
				<td>{{$payment->role}}</td>
			</tr>

			<tr>
				<td colspan="4"><strong>DIRECCIÓN</strong></td>
			</tr>

			<tr>
				<td colspan="4">{{$payment->address}} </td>
			</tr>

			<tr>
				<td style="width:25%;"><strong>TIPO DE LIQUIDACIÓN</strong> </td>
				<td style="width:25%;"><strong>FECHA DE INGRESO</strong></td>
				<td style="width:25%;"><strong>FECHA DE EGRESO</strong></td>
				<td style="width:25%;"><strong>TIEMPO DE SERVICIO</strong></td>
			</tr>

			<tr>
				<td>{{$payment->reason}} </td>
				<td>{{$payment->startdate}} </td>
				<td>{{$payment->stopdate}} </td>
				<td>{{$payment->servicetime}} </td>
			</tr>
			
			<tr>
				<td colspan="2"><strong>SALARIO BÁSICO MENSUAL (Bs.)</strong></td>
				<td colspan="2"><strong>SALARIO BÁSICO DIARIO (Bs.)</strong></td>
			</tr>

			<tr>
				<td colspan="2">{{$payment->salary * 30}} </td>
				<td colspan="2">{{$payment->salary}}</td>
			</tr>

		</table>

		<table style="font-size:9px; text-align: center">

			<tr>
				<td colspan="4"><strong>ASIGNACIONES</strong></td>
			</tr>

			<tr>
				<td><strong>CONCEPTOS</strong></td>
				<td><strong>DÍAS</strong></td>
				<td><strong>SALARIO BASE CALCULADO</strong></td>
				<td style="width:20%;"><strong>MONTO Bs.</strong></td>
			</tr>	

			<tr>
				<td style="text-align:left;">ANTIGUEDAD CLAUSULA 46 C.C.C</td>
				<td>{{$payment->antiquity_days}}</td>
				<td>{{$payment->salary}}</td>
				<td>{{$payment->antiquity_total}}</td>
			</tr>

			<tr>
				<td style="text-align:left;">UTILIDADES CLAUSULA 44 C.C.C</td>
				<td>{{$payment->utilities_days}}</td>
				<td>{{$payment->salary}}</td>
				<td>{{$payment->utilities_total}}</td>
			</tr>

			<tr>
				<td style="text-align:left;">VACACIONES CLAUSULA 43 C.C.C</td>
				<td rowspan="4">{{$payment->vacations_days}}</td>
				<td rowspan="4">{{$payment->salary}}</td>
				<td rowspan="4">{{$payment->vacations_total}}</td>

			</tr>
			
			<tr>
				<td style="text-align:left;">BONO VACACIONAL CLAUSULA 43 C.C.C</td>
			</tr>
			
			<tr>
				<td style="text-align:left;">VACACIONES FRACCIONADAS CLAUSULA 43 C.C.C</td>
			</tr>

			<tr>
				<td style="text-align:left;">BONO VACACIONAL FRACCIONADO CLAUSULA 43 C.C.C</td>
			</tr>

			<tr>
				<td style="text-align:left;">SALARIOS CAIDOS</td>
				<td>{{$payment->down_salaries_days}}</td>
				<td>{{$payment->salary}}</td>
				<td>{{$payment->down_salaries_total}}</td>
			</tr>

			<tr>
				<td colspan="3" style="text-align:right;"><strong>TOTAL ASIGNACIONES</strong></td>
				<td>{{$payment->assignments_total}}</td>
			</tr>

			<tr>
				<td colspan="4"><strong>DEDUCCIONES</strong></td>
			</tr>

			<tr>
				<td colspan="3"><strong>CONCEPTOS</strong></td>
				<td><strong>MONTO Bs.</strong></td>
			</tr>

			<tr>
				<td colspan="3" style="text-align:left;">ANTICIPOS RECIBIDOS</td>
				<td>{{$payment->received_advances}}</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align:left;">PRÉSTAMOS</td>
				<td>{{$payment->received_loans}}</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align:left;">OTROS</td>
				<td>{{$payment->others}}</td>
			</tr>

			<tr>
				<td colspan="3" style="text-align:right;"><strong>TOTAL DEDUCCIONES</strong></td>
				<td>{{$payment->deductions_total}}</td>
			</tr>
		
			<tr>
				<td colspan="3" style="text-align:right;"><strong>TOTAL LIQUIDACIÓN DE PRESTACIONES SOCIALES</strong></td>
				<td>{{$payment->total}}</td>
			</tr>

			<tr>
				<td colspan="4" style="text-align:justify;"> SON Bs. {{$payment->total}}, CANTIDAD QUE RECIBO Y ACEPTO EN ESTA MISMA FECHA, EN DINERO EFECTIVO Y A SATISFACCIÓN, MEDIANTE CHEQUE N˚ {{ $payment->check }} DEL BANCO DE VENEZUELA, HACIENDO CONSTAR QUE NO TENGO NADA QUE RECLAMAR SOBRE LO ARRIBA INDICADO.</td>
			</tr>	
		
		</table>

		<div class="space1"></div>

		<table style="font-size:9px; text-align: center">

			<tr>
				<td colspan="4"><strong>FIRMAS</strong></td>
			</tr>

			<tr>
				<td colspan="2" style="width:50%;"><strong>GERENCIA GENERAL</strong></td>
				<td colspan="2" rowspan="2"><strong>TRABAJADOR</strong></td>
			</tr>

			<tr>
				<td><strong>ELABORADO POR</strong></td>
				<td><strong>REVISADO POR</strong></td>
		    </tr>

			<tr>
				<td style="height:90px; width:25%;"></td>
				<td style="height:90px;"></td>
				<td colspan="2" style="height:90px;"></td>
			</tr>

			<tr>
				<td>ADMINISTRACIÓN</td>
				<td>GERENCIA GENERAL</td>
				<td>{{$payment->fullname}} - C.I: {{$payment->pin}} </td>
			</tr>

			<tr>
				<td colspan="2"><strong>FECHA:</strong> {{ date('d-m-Y',strtotime($payment->createdate)) }} </td>
				<td colspan="2"><strong>FECHA: __-__-____</strong></td>
			</tr>	

		</table>

	</div>

@endsection