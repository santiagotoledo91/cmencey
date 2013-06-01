{{ Form::open('admin/paysheets/save','POST', array('class' => 'form-horizontal')) }}

<div class="container-fluid">

	<div class="row-fluid">

		<div class="span12">

			<legend>Vista preliminar - Nómina {{$startdate}} al {{$stopdate}}</legend>

			<table class="table table-bordered table-hover" style="font-size: 12px">

				<tr class="head well">

					<th>C.I</th>
					<th>NOMBRE</th>
					<th>SALARIO BASE SEMANAL</th>
					<th>BONO DE ALIMENTACION</th>
					<th>HORAS EXTRA</th>
					<th>BONO DE PRODUCCION</th>
					<th>PRIMAS EXTRAORDINARIAS</th>
					<th>OTROS</th>
					<th>TOTAL DEVENGADO</th>
					<th>PRESTAMOS RECIBIDOS</th>
					<th>SSO</th>
					<th>PARO FORZOSO</th>
					<th>FAOV</th>
					<th>TOTAL A PAGAR</th>

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
					<td>Bs. {{ $employee->received_loans 	}}	</td>
					<td>Bs. {{ $employee->sso 				}}	</td>
					<td>Bs. {{ $employee->forced_stop		}}	</td>
					<td>Bs. {{ $employee->faov 				}}	</td>
					<td>Bs. {{ $employee->net_total 		}}	</td>

				</tr>

			@endforeach

			</table>

			<h4 class="text-right">TOTAL = Bs. {{$total}}</h4>

			<div class="text-center">

				<button id="submit" name="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Guardar</button>

			</div>

		</div>

	</div>

</div>

{{ Form::close() }}

