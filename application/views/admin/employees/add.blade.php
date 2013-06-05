@layout('layouts.admin')
@section('content')
<div class="container-fluid">

	<div class="row-fluid">

		<div class="span10 offset1">

			<div class="row-fluid">
				
				<legend>Nuevo empleado</legend>
			
			</div>

			<div class="row-fluid">

				{{ Form::open('admin/employees/add','POST', array('class' => 'form-horizontal')) }}

				<div class="span6">

					<div class="control-group">

						<label class="control-label">Cedula de identidad</label>

						<div class="controls">

							<input id="employee_pin" name="employee_pin" type="text" placeholder="Ej: 15257593" maxlength="8" class="span10" required>

						</div>

					</div>

					<div class="control-group">

						<label class="control-label">Nombres</label>

						<div class="controls">

							<input id="employee_firstnames" name="employee_firstnames" type="text" maxlength="100" class="span10" required>

						</div>

					</div>

					<div class="control-group">

						<label class="control-label">Apellidos</label>

						<div class="controls">

							<input id="employee_lastnames" name="employee_lastnames" type="text" maxlength="100" class="span10" required>

						</div>

					</div>

					<div class="control-group">

						<label class="control-label">Cargo</label>

						<div class="controls">

							<input id="employee_role" name="employee_role" type="text" placeholder="Ej: Obrero" maxlength="200" class="span10" required>

						</div>

					</div>

					<div class="control-group">

						<label class="control-label">Salario diario (Bs.)</label>

						<div class="controls">

							<input id="employee_salary" name="employee_salary" type="text" placeholder="Ej: 150" maxlength="8" class="span10" required>

						</div>

					</div>

					<div class="control-group">

						<label class="control-label">Teléfono</label>

						<div class="controls">

							<input id="employee_phone" name="employee_phone" type="text" placeholder="Ej: 04241235565" maxlength="11" class="span10" required>

						</div>

					</div>

					<div class="control-group">

						<label class="control-label">Dirección</label>

						<div class="controls">

							<textarea id="employee_address" name="employee_address" class="span10" required></textarea>

						</div>

					</div>

					<div class="control-group">

						<label class="control-label">Cuenta bancaria N˚ (Banco de venezuela)</label>

						<div class="controls">

							<input id="employee_bank_account" name="employee_bank_account" type="text" class="span10" placeholder="Ej: 0116077880015459039" maxlength="20" required>

						</div>

					</div>

				</div>

				<div class="span6">

					<div class="control-group">

						<label class="control-label">Talla de camisa</label>

						<div class="controls">

							<input id="employee_size_shirt" name="employee_size_shirt" type="text" class="span10" placeholder="Ej: S - M - L - XL - XXL" maxlength="3">

						</div>

					</div>

					<div class="control-group">

						<label class="control-label">Talla de zapatos</label>

						<div class="controls">

							<input id="employee_size_shoes" name="employee_size_shoes" type="text" class="span10" placeholder="Ej: 40 - 42 - 44" maxlength="2">

						</div>

					</div>

					<div class="control-group">

						<label class="control-label">Talla de pantalon</label>

						<div class="controls">

							<input id="employee_size_pant" name="employee_size_pant" type="text" class="span10" placeholder="Ej: 32 - 34 - 36" maxlength="2">

						</div>

					</div>
			

				</div>

			</div>	

			<div class="row-fluid">

				<div class="span2 offset5">

					<div class="control-group">

						<div class="controls">

							<button id="submit" name="submit" class="btn btn-primary btn-block"><i class="icon-ok icon-white"></i> Añadir empleado</button>

						</div>

					</div>

				</div>

			</div>

			{{ Form::close() }}
		
		</div>

	</div>

</div>
@endsection

