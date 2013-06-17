@layout('layouts.admin')
@section('content')
<div class="container-fluid">

	<div class="row-fluid">

		<div class="span10 offset1">

			<div class="row-fluid">
				
				<h4 class="text-center">Liquidación</h4>
				<div class="space1"></div>

			</div>
			
			<div class="row-fluid white-area">
				
				{{ Form::open('admin/socialbeneficts/view','POST', array('class' => 'form-horizontal white-area-content')) }}
				
				

				<div class="span6">
		
					<div class="control-group">

						<label class="control-label">Cédula de identidad:</label>

						<label class="control-label" style="text-align:left; margin-left:20px;"><strong>{{ $employee->pin }}</strong></label>

					</div>

					<div class="control-group">

						<label class="control-label">Nombre Completo:</label>

						<label class="control-label" style="text-align:left; margin-left:20px;"><strong>{{ $employee->fullname }}</strong></label>

					</div>

					<div class="control-group">

						<label class="control-label">Cargo:</label>

						<label class="control-label" style="text-align:left; margin-left:20px;"><strong>{{ $employee->role }}</strong></label>

					</div>

					<div class="control-group">

						<label class="control-label">Dirección:</label>

						<label class="control-label" style="text-align:left; margin-left:20px;"><strong>{{ $employee->address }}</strong></label>

					</div>

					<div class="control-group">

						<label class="control-label">Salario diario (Bs.):</label>

						<label class="control-label" style="text-align:left; margin-left:20px;"><strong>{{ $employee->salary }}</strong></label>

					</div>

					<div class="control-group">

						<label class="control-label">Fecha de ingreso</label>

						<div class="controls">

							<input name="startdate" type="text" class="input-small" placeholder="DD-MM-AAAA" maxlength="10" value="{{$employee->startdate}}" required="required">

						</div>

					</div>

					<div class="control-group">

						<label class="control-label">Fecha de egreso</label>

						<div class="controls">

							<input name="stopdate" type="text" class="input-small" placeholder="DD-MM-AAAA" maxlength="10" required="required">

						</div>

					</div>

				</div>
				
				<div class="span6">



					<div class="control-group">
						
						<label class="control-label">Tipo de liquidación</label>
						
						<div class="controls">
							
							<select name="reason" class="input-medium">
							
								<option value="Mutuo Acuerdo">Mutuo acuerdo</option>
								<option value="Renuncia">Renuncia</option>
								<option value="Despido">Despido</option>
							
							</select>	
						
						</div>
					
					</div>

					<div class="control-group">
						
						<label class="control-label"><strong>Asignaciones</strong></label>

					</div>

					<div class="control-group">
						
						<label class="control-label">Salarios caidos (Dias)</label>

						<div class="controls">

							<input name="down_salaries_days" type="text" class="input-mini" maxlength="2" value="0">

						</div>

					</div>

					<div class="control-group">
						
						<label class="control-label"><strong>Deducciones</strong></label>

					</div>

					<div class="control-group">
						
						<label class="control-label">Anticipos recibidos (Bs.)</label>

						<div class="controls">

							<input name="received_advances" type="text" class="input-mini" maxlength="5" value="0">

						</div>

					</div>

					<div class="control-group">
						
						<label class="control-label">Préstamos recibidos (Bs.)</label>

						<div class="controls">

							<input name="received_loans" type="text" class="input-mini" maxlength="5" value="0">

						</div>

					</div>

					<div class="control-group">
						
						<label class="control-label">Otros (Bs.)</label>

						<div class="controls">

							<input name="others" type="text" class="input-mini" maxlength="5" value="0">

						</div>

					</div>

					<div class="control-group">
						
						<label class="control-label">Cheque #:</label>

						<div class="controls">

							<input name="check" type="text" class="input-mini" maxlength="5" value="0">

						</div>

					</div>

				</div>
	
			</div>

			<div class="row-fluid">

				<div class="span2 offset5">

					<div class="control-group">

						<div class="controls">

							<div class="space1"></div>
							<button id="submit" name="submit" class="btn btn-primary btn-block"><i class="icon-ok icon-white"></i> Vista preliminar</button>

						</div>

					</div>

				</div>

			</div>
			
			<input type="hidden" name="id" value="{{ $employee->id }}">

			{{ Form::close() }}

		</div>

	</div>

</div>

 @endsection
