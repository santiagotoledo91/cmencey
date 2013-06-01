{{ Form::open('admin/paysheets/view','POST', array('class' => 'form-horizontal')) }}

<div class="container-fluid">

	<div class="row-fluid">

		<div class="span12">

			<legend>Prenómina - Inicio: <input type="text" name="startdate" class="input-small" placeholder="Ej:2013-05-23"></legend>
	

			<table class="table table-bordered table-hover" style="font-size: 12px">

				<tr class="head well">

					<th>C.I</th>
					<th>NOMBRE</th>
					<th>SALARIO BASE SEMANAL</th>
					<th>LU</th>
					<th>MA</th>
					<th>MI</th>
					<th>JU</th>
					<th>VI</th>
					<th>SA</th>
					<th>DO</th>
					<th>HORAS EXTRA</th>
					<th>BONO DE PRODUCCION</th>
					<th>OTROS</th>
					<th>PRIMAS EXTRAORDINARIAS</th>
					<th>PRESTAMOS RECIBIDOS</th>
					<th>INCLUIR</th>

				</tr>

			@foreach ($employees as $employee)

				<tr>

					<input type="hidden" name="id[]" value="{{ $employee->id }}">
					<td> {{ $employee->pin }} </td>
					<td> {{ $employee->fullname }} </td>
					<td>Bs. {{ $employee->salary * 7}} </td>
					<td> <input type="checkbox" name="mo[{{ $employee->id }}]" checked></td>
					<td> <input type="checkbox" name="tu[{{ $employee->id }}]" checked></td>
					<td> <input type="checkbox" name="we[{{ $employee->id }}]" checked></td>
					<td> <input type="checkbox" name="th[{{ $employee->id }}]" checked></td>
					<td> <input type="checkbox" name="fr[{{ $employee->id }}]" checked></td>
					<td> <input type="checkbox" name="sa[{{ $employee->id }}]"></td>
					<td> <input type="checkbox" name="su[{{ $employee->id }}]"></td>
					<td>Bs.<input type="text" name="extra_hours[{{ $employee->id }}]" class="span4" value="0"></td>
					<td>Bs.<input type="text" name="production_bonus[{{ $employee->id }}]" class="span4" value="0"></td>
					<td>Bs.<input type="text" name="others[{{ $employee->id }}]" class="span4" value="0"></td>
					<td>Bs.<input type="text" name="extra_raws[{{ $employee->id }}]" class="span4" value="0"></td>
					<td>Bs.<input type="text" name="received_loans[{{ $employee->id }}]" class="span4" value="0"></td>
					<td> <input type="checkbox" name="include[{{ $employee->id }}]" checked></td>

				</tr>

			@endforeach

			</table>

			<div class="text-center">

				<button id="submit" name="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Vista preliminar</button>

			</div>

		</div>

	</div>

</div>

{{ Form::close() }}
