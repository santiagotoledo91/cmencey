<div class="container-fluid">

	<div class="row-fluid">

		<div class="span9">

			<div class="row-fluid">

				<legend>Editar perfil del empleado</legend>

			</div>

			<div class="row-fluid">

				{{ Form::open('admin/employees/edit/'.$employee->id,'POST', array('class' => 'form-horizontal')) }}

				<div class="span5">

					<div class="control-group">

						<label class="control-label">Cedula de identidad</label>

						<div class="controls">

							<h5>{{ $employee->pin }}</h5>

						</div>

					</div>

					<div class="control-group">

						<label class="control-label">Nombre Completo</label>

						<div class="controls">

							<h5>{{ $employee->fullname }}</h5>

						</div>

					</div>

					<div class="control-group">

						<label class="control-label">Cargo</label>

						<div class="controls">

							<input id="employee_role" name="employee_role" type="text" value="{{ $employee->role }}" maxlength="200" class="span12" required>

						</div>

					</div>

					<div class="control-group">

						<label class="control-label">Salario (Bs.)</label>

						<div class="controls">

							<input id="employee_salary" name="employee_salary" type="text" value="{{ $employee->salary }}" maxlength="8" class="span12" required>

						</div>

					</div>

					<div class="control-group">

						<label class="control-label">Teléfono</label>

						<div class="controls">

							<input id="employee_phone" name="employee_phone" type="text" maxlength="11" value="{{ $employee->phone }}" class="span12" required>

						</div>

					</div>

					<div class="control-group">

						<label class="control-label">Dirección</label>

						<div class="controls">

							<textarea id="employee_address" name="employee_address" class="span12" required>{{ $employee->address }}</textarea>

						</div>

					</div>

					<div class="control-group form-vertical">

						<label class="control-label">Activo</label>

						<div class="controls">	

							@if ($employee->active == 1)

								<label class="radio">

									<input type="radio" name="employee_active" id="employee_active" value="1" required checked> Si 

								</label>

								<label class="radio">

									<input type="radio" name="employee_active" id="employee_active" value="0" required> No

								</label>

							@else

								<label class="radio">

									<input type="radio" name="employee_active" id="employee_active" value="1" required> Si 

								</label>

								<label class="radio">

									<input type="radio" name="employee_active" id="employee_active" value="0" required checked> No

								</label>

							@endif

						</div>

					</div>

				</div>

				<div class="span7">

					<div class="condsatrol-group">

						<div class="controls">

							<div class="span12" style="height:380px; overflow:auto;">

								<table class="table">

									<tr>

										<th>Documento</th>
										
										<th>Status</th>

									</tr>

									@foreach ($documents as $document)

									<tr class="{{$document->row_class}}">

										<td> <label> {{ $document->description }} </label></td>

										{{ $document->show }}

									</tr>

									@endforeach

								</table>

							</div>

						</div>

					</div>

				</div>

			</div>	

			<div class="row-fluid">

				<div class="span2 offset5">

					<div class="control-group">

						<div class="controls">

							<button id="submit" name="submit" class="btn btn-primary btn-block"><i class="icon-ok icon-white"></i> Guardar</button>

						</div>

					</div>

				</div>

			</div>

			{{ Form::close() }}

		</div>

		<div class="span3">

			<legend>Ayuda</legend>
			Informacion necesaria

		</div>

	</div>

</div>

