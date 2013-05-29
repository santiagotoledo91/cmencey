{{ Form::open('admin/paysheets/view','POST', array('class' => 'form-horizontal')) }}

<div class="container-fluid">

	<div class="row-fluid">

		<div class="span12">

			<legend>Prenómina (25-05-2013 al 31-05-2013)</legend>

			<table class="table table-bordered table-hover">

				<tr class="head well">

					<th>C.I</th>
					<th>NOMBRE</th>
					<th>SALARIO BASE SEMANAL</th>
					<th>INCLUIR</th>

				</tr>

			@foreach ($employees as $employee)

				<tr>
					
					<input type="hidden" name="id[]" value="{{ $employee->id }}">
					<td> {{ $employee->pin }} </td>
					<td> {{ $employee->fullname }} </td>
					<td>Bs. {{ $employee->salary * 7}} </td>
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
