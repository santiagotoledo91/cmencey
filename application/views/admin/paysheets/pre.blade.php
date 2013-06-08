@layout('layouts.admin')
@section('content')
{{ Form::open('admin/paysheets/view','POST', array('class' => 'form-horizontal')) }}

<div class="container-fluid">

	<div class="row-fluid">

		<div class="span12">

			@if (!empty($employees))
				
				<h4 class="text-center"> Prenómina - Fecha de inicio:  <input type="text" name="startdate" class="input-small" placeholder="Ej:2013-05-23" required value="{{$startdate}}"></h4>
				<div class="space1"></div>
				
				<table class="table table-bordered table-hover" style="font-size: 12px">

					<tr class="head well">

						<th style="text-align: center;">C.I</th>
						<th style="text-align: center;">NOMBRE</th>
						<th style="text-align: center;width: 84px;">SALARIO BASE SEMANAL</th>
						<th style="text-align: center;">LU</th>
						<th style="text-align: center;">MA</th>
						<th style="text-align: center;">MI</th>
						<th style="text-align: center;">JU</th>
						<th style="text-align: center;">VI</th>
						<th style="text-align: center;">SA</th>
						<th style="text-align: center;">DO</th>
						<th style="text-align: center;">HORAS EXTRA</th>
						<th style="text-align: center;">BONO DE PRODUCCION</th>
						<th style="text-align: center;">OTROS</th>
						<th style="text-align: center;">PRIMAS EXTRAORD.</th>
						<th style="text-align: center;">PRESTAMOS RECIBIDOS</th>
						<th style="text-align: center;">INCLUIR</th>

					</tr>

				@foreach ($employees as $employee)

					<tr style="text-align: center">

						<input type="hidden" name="id[]" value="{{ $employee->id }}">
						<td> {{ $employee->pin }} </td>
						<td> {{ $employee->fullname }} </td>
						<td style="text-align: center;">Bs. {{ $employee->salary * 7}} </td>
						<td style="text-align: center;"> <input type="checkbox" name="mo[{{ $employee->id }}]" checked></td>
						<td style="text-align: center;"> <input type="checkbox" name="tu[{{ $employee->id }}]" checked></td>
						<td style="text-align: center;"> <input type="checkbox" name="we[{{ $employee->id }}]" checked></td>
						<td style="text-align: center;"> <input type="checkbox" name="th[{{ $employee->id }}]" checked></td>
						<td style="text-align: center;"> <input type="checkbox" name="fr[{{ $employee->id }}]" checked></td>
						<td style="text-align: center;"> <input type="checkbox" name="sa[{{ $employee->id }}]"></td>
						<td style="text-align: center;"> <input type="checkbox" name="su[{{ $employee->id }}]"></td>
						<td style="width: 84px;text-align: center;">Bs. <input type="text" name="extra_hours[{{ $employee->id }}]" value="0" style="width: 35px;"</td>
						<td style="width: 84px;text-align: center;">Bs. <input type="text" name="production_bonus[{{ $employee->id }}]" value="0" style="width: 35px;"></td>
						<td style="width: 84px;text-align: center;">Bs. <input type="text" name="others[{{ $employee->id }}]" value="0" style="width: 35px;"></td>
						<td style="width: 84px;text-align: center;">Bs. <input type="text" name="extra_raws[{{ $employee->id }}]" value="0" style="width: 35px;"></td>
						<td style="width: 84px;text-align: center;">Bs. <input type="text" name="received_loans[{{ $employee->id }}]" value="0" style="width: 35px;"></td>
						<td style="text-align: center;"> <input type="checkbox" name="include[{{ $employee->id }}]" checked></td>

					</tr>

				@endforeach

				</table>

				<div class="text-center">

					<button id="submit" name="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Vista preliminar</button>

				</div>
			@else

				<h4 class="text-center"> Es imposible generar la nomina sin empleados activos.</h4>
				<h4 class="text-center"> ¿Por que no intenta primero {{ HTML::link('admin/employees/add','agregar') }} un nuevo empleado o {{ HTML::link('admin/employees/manage','activar') }} uno existente?</h4>

			@endif
		</div>

	</div>

</div>

{{ Form::close() }}
@endsection