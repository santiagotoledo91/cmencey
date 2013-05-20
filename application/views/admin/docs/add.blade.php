<div class="container-fluid">

	<div class="row-fluid">

		<div class="span9">

			<div class="row-fluid">
				
				<legend>Nuevo documento</legend>

			</div>

			<div class="row-fluid">
				
				{{ Form::open('admin/docs/add','POST', array('class' => 'form-horizontal')) }}

				<div class="span6 offset3">

					<div class="control-group">

						<label class="control-label">Nombre</label>

						<div class="controls">

							<input id="document_type_description" name="document_type_description" type="text" placeholder="Nombre del documento" class="input" required="">

						</div>

					</div>

					<div class="control-group">

						<label class="control-label">Renovacion</label>

						<div class="controls">

							<select id="document_type_expires_in" name="document_type_expires_in" class="input">
								<option value="7">Semanal</option>s
								<option value="30">Mensual</option>
								<option value="90">Trimestral</option>
								<option value="180">Semestral</option>
								<option value="365">Anual</option>
								<option value="0">No aplica</option>
							</select>

						</div>

					</div>
				
				</div>	

				<div class="span6">
				
					<!-- for further fields -->

				</div>

			</div>

			<div class="row-fluid">
			
				<div class="span2 offset5">
					
					<div class="control-group">

						<div class="controls">
						
							<button id="submit" name="submit" class="btn btn-primary btn-block"><i class="icon-ok icon-white"></i> Añadir</button>
					
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

	
	</div>

</div>