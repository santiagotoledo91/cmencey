@layout('layouts.admin')
@section('content')
{{ Form::open('admin/paysheets/save','POST', array('class' => 'form-horizontal')) }}

<div class="container-fluid">

	<div class="row-fluid">

		<div class="span12">

			<h4 class="text-center">Vista preliminar - Nómina {{$startdate}} al {{$stopdate}}</h4>
			<div class="space1"></div>
			
			<table class="table table-bordered table-hover " style="font-size: 11px">

				<tr class="text-center">

					<th rowspan="2" style="width:1px;">C.I</th>
					<th rowspan="2" >NOMBRE</th>
					<th colspan="6">ASIGNACIONES</th>
					<th rowspan="2" style="width:50px;">TOTAL DEVENGADO</th>
					<th colspan="5">DEDUCCIONES</th>
					<th rowspan="2" style="width:50px;">TOTAL A PAGAR</th>

				</tr>

				<tr class="text-center">
					<th style="width:55px;">SALARIO BASE SEMANAL</th>
					<th style="width:55px;">BONO DE ALIMENT.</th>
					<th style="width:55px;">HORAS EXTRA</th>
					<th style="width:55px;">BONO DE PROD.</th>
					<th style="width:55px;">PRIMAS EXT.</th>
					<th style="width:55px;">OTROS</th>
					<th style="width:55px;">SSO</th>
					<th style="width:55px;">PARO FORZOSO</th>
					<th style="width:55px;">FAOV</th>
					<th style="width:55px;">INCES</th>
					<th style="width:55px;">PRESTAMOS RECIBIDOS</th>
					
				</tr>

			@foreach ($employees as $employee)

				<tr>

					<input type="hidden" name="id[]" value="{{ $employee->id }}">
					<td> 	{{ $employee->pin 				}}	</td>
					<td> 	{{ $employee->fullname			}}	</td>
					<td>Bs. {{ $employee->salary * 7 		}} 	</td>
					<td>Bs. {{ $employee->feeding_bonus 	}}	</td>
					<td>Bs. {{ $employee->extra_hours		}}	</td>
					<td>Bs. {{ $employee->production_bonus 	}}	</td>
					<td>Bs. {{ $employee->extra_raws 		}}	</td>
					<td>Bs. {{ $employee->others 			}}	</td>
					<td>Bs. {{ $employee->accrued_total 	}}	</td>
					<td>Bs. {{ $employee->sso 				}}	</td>
					<td>Bs. {{ $employee->forced_stop		}}	</td>
					<td>Bs. {{ $employee->faov 				}}	</td>
					<td>Bs. {{ $employee->inces				}}	</td>
					<td>Bs. {{ $employee->received_loans 	}}	</td>
					<td>Bs. {{ $employee->net_total 		}}	</td>

				</tr>

			@endforeach

				<tr>
					<td colspan="15"><h4 class="text-center">TOTAL = Bs. {{$total}}</h4></td>
				</tr>

			</table>

			

			<div class="text-center">

				<button id="submit" name="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Guardar</button>

			</div>

		</div>

	</div>

</div>

{{ Form::close() }}
@endsection

