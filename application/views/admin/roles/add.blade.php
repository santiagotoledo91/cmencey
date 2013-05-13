<div class="container-fluid wallet" style="margin-top: 200px">

	<div class="row-fluid">

		<div class="span4 offset4">

			{{ Form::open('admin/roles/add','POST', array('class' => 'form-horizontal')) }}

			<legend>Nuevo cargo</legend>

				<div class="control-group">
					
					<label class="control-label">Nombre</label>

					<div class="controls">
						<input id="name" name="name" type="text" placeholder="Nombre del cargo" class="input" required="">
					</div>

				</div>

				<div class="control-group">
				
					<label class="control-label">Salario (Bs.)</label>
					
					<div class="controls">
						<input id="salary" name="salary" type="text" placeholder="Ej: 4500" class="input" required="">
					</div>
				
				</div>

				<div class="control-group">
				
					<div class="controls">
						<button id="submit" name="submit" class="btn btn-primary">Añadir</button>
					</div>
				
				</div>
		
			{{ Form::close() }}

		</div>

	</div>

</div>
