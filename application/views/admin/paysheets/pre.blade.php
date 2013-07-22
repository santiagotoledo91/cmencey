@layout('layouts.admin')
@section('content')
{{ Form::open('admin/paysheets/view','POST', array('class' => 'form-horizontal')) }}

<div class="container-fluid">

	<div class="row-fluid">

		<div class="span12">

			@if (!empty($employees))
				
				<h4 class="text-center"> Prenómina - Fecha de inicio:  <input type="text" name="startdate" class="input-small" placeholder="DD-MM-AAAA" value="{{$startdate}}" maxlength="10" required=required></h4>
				<div class="space1"></div>
				
				<?php $errors_msg = array_filter($errors->all()) ?>
				
				@if  (!empty($errors_msg))

					<p style="color: red; text-align:center; margin-left:55px; margin-bottom:1px;">Verifique todos los campos (Solo se aceptan números. Todos los campos son requeridos).</p>

				@endif
				
				<table class="table table-bordered table-hover" style="font-size: 12px">

					<tr class="text-center">

						<th rowspan="2">C.I</th>
						<th rowspan="2">NOMBRE</th>
						<th rowspan="2" style="width: 84px;">SALARIO BASE SEMANAL</th>
						<th rowspan="2">LU</th>
						<th rowspan="2">MA</th>
						<th rowspan="2">MI</th>
						<th rowspan="2">JU</th>
						<th rowspan="2">VI</th>
						<th rowspan="2">SA</th>
						<th rowspan="2">DO</th>
						<th colspan="4">ASIGNACIONES</th>
						<th>DEDUCCIONES</th>
						<th rowspan="2">INCLUIR</th>

					</tr>

					<tr class="text-center">

						<th >HORAS EXTRA</th>
						<th >BONO DE PRODUCCION</th>
						<th >PRIMAS EXTRAORD.</th>
						<th >OTROS</th>
						<th >PRESTAMOS RECIBIDOS</th>

					</tr>

				@foreach ($employees as $employee)

					<tr>

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
						<td style="width: 84px;text-align: center;">Bs. <input type="text" name="extra_hours[{{ $employee->id }}]" value="0" style="width: 35px;"></td>
						<td style="width: 84px;text-align: center;">Bs. <input type="text" name="production_bonus[{{ $employee->id }}]" value="0" style="width: 35px;"></td>
						<td style="width: 84px;text-align: center;">Bs. <input type="text" name="extra_raws[{{ $employee->id }}]" value="0" style="width: 35px;"></td>
						<td style="width: 84px;text-align: center;">Bs. <input type="text" name="others[{{ $employee->id }}]" value="0" style="width: 35px;"></td>
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