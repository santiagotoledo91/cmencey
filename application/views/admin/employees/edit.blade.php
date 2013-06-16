@layout('layouts.admin')
@section('content')
<div class="container-fluid">

	<div class="row-fluid">

		<div class="span10 offset1">

			<div class="row-fluid">

				<h4 class="text-center" style="margin-bottom:0px">Editar empleado</h4>
				
				{{ Form::open('admin/employees/edit/'.$employee->id,'POST', array('class' => 'form-horizontal')) }}

				<ul class="nav nav-tabs" id="myTab" style="margin-bottom: 0px;border-bottom: 0px;">
					
					<li class="active">
						<a href="#profile" data-toggle="tab"><strong>Informacion General</strong></a>
					</li>
					
					<li>
						<a href="#documents" data-toggle="tab"><strong>Documentos</strong></a>
					</li>

				</ul>

				<div class="tab-content white-area ">

					<div class="tab-pane active white-area-content" id="profile">
						
						<div class="span5 offset1">

							<div class="control-group">

								<label class="control-label">Cedula de identidad:</label>

								<label class="control-label" style="text-align:left; margin-left:20px;"><strong>{{ $employee->pin }}</strong></label>

							</div>

							<div class="control-group">

								<label class="control-label">Nombre Completo:</label>

								<label class="control-label" style="text-align:left; margin-left:20px;"><strong>{{ $employee->fullname }}</strong></label>

							</div>

							<div class="control-group">

								<label class="control-label">Cargo</label>

								<div class="controls">

									<input id="employee_role" name="employee_role" type="text" value="{{ $employee->role }}" maxlength="200" class="span10" required>

								</div>

							</div>

							<div class="control-group">

								<label class="control-label">Salario diario (Bs.)</label>

								<div class="controls">

									<input id="employee_salary" name="employee_salary" type="text" value="{{ $employee->salary }}" maxlength="8" class="span10" required>

								</div>

							</div>

							<div class="control-group">

								<label class="control-label">Teléfono</label>

								<div class="controls">

									<input id="employee_phone" name="employee_phone" type="text" maxlength="11" value="{{ $employee->phone }}" class="span10" required>

								</div>

							</div>

							<div class="control-group">

								<label class="control-label">Dirección</label>

								<div class="controls">

									<textarea id="employee_address" name="employee_address" class="span10" required>{{ $employee->address }}</textarea>

								</div>

							</div>

							<div class="control-group">

								<label class="control-label">Cuenta bancaria N˚ (Banco de venezuela)</label>

								<div class="controls">

									<input id="employee_bank_account" name="employee_bank_account" type="text" class="span10" value="{{ $employee->bank_account }}"  maxlength="23" placeholder="Ej: 0116 0778 80 015459039">

								</div>

							</div>

						</div>

						<div class="span5">

							<div class="control-group">

								<label class="control-label">Talla de camisa</label>

								<div class="controls">

									<input id="employee_size_shirt" name="employee_size_shirt" type="text" class="span10" placeholder="Ej: S - M - L - XL - XXL" maxlength="3" value="{{ $employee->size_shirt }}">

								</div>

							</div>

							<div class="control-group">

								<label class="control-label">Talla de zapatos</label>

								<div class="controls">

									<input id="employee_size_shoes" name="employee_size_shoes" type="text" class="span10" placeholder="Ej: 40 - 42 - 44" maxlength="2" value="{{ $employee->size_shoes }}">

								</div>

							</div>

							<div class="control-group">

								<label class="control-label">Talla de pantalon</label>

								<div class="controls">

									<input id="employee_size_pant" name="employee_size_pant" type="text" class="span10" placeholder="Ej: 32 - 34 - 36" maxlength="2" value="{{ $employee->size_pant }}">

								</div>

							</div>

							<div class="control-group">

								<label class="control-label">Fecha de ingreso</label>

								<div class="controls">

									<input id="employee_startdate" name="employee_startdate" type="text" class="span10" placeholder="DD-MM-AAAA" maxlength="10" value="{{ $employee->startdate }}">

								</div>

							</div>

							<div class="control-group">

								<label class="control-label">Fecha de egreso</label>

								<div class="controls">

									<input id="employee_stopdate" name="employee_stopdate" type="text" class="span10" placeholder="DD-MM-AAAA" maxlength="10" value="{{ $employee->stopdate }}">

								</div>

							</div>

							<div class="control-group">

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

					</div>

		 			<div class="tab-pane" id="documents">

						<div class="span12" style="height:425px; overflow:auto; padding:0px;">
							
							<div class="control-group">

								<div>

									@if (!empty($documents))

										<table class="table table-hover table-documents">

											<tr>

												<th>Documento</th>
												
												<th>Status</th>

											</tr>

											@foreach ($documents as $document)

											<tr class="{{$document->row_class}}">

												<td> {{ $document->description }} </td>

												{{ $document->show }}

											</tr>

											@endforeach
										
										</table>

									@endif

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

			<div class="row-fluid">

				<div class="span2 offset5">

					<div class="control-group">

						<div class="controls">

							<button id="submit" name="submit" class="btn btn-primary btn-block"><i class="icon-ok icon-white"></i> Actualizar</button>

						</div>

					</div>

				</div>

			</div>

			{{ Form::close() }}

		</div>

	</div>

</div>

 @endsection
