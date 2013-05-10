<div class="container-fluid wallet" style="margin-top: 200px">

	<div class="row-fluid">

		<div class="span4 offset4">

			{{ Form::open('admin/docs/add','POST', array('class' => 'form-horizontal')) }}

			<legend>Añadir nuevo documento</legend>

			<!-- Text input-->
			<div class="control-group">

				<label class="control-label">Nombre</label>

				<div class="controls">

					<input id="document_name" name="document_name" type="text" placeholder="Nombre del documento" class="input" required="">

				</div>

			</div>

			<!-- Select Basic -->
			<div class="control-group">

				<label class="control-label">Renovacion</label>

				<div class="controls">

					<select id="document_expiration" name="expiration" class="input">
						<option value="7">Semanal</option>
						<option value="30">Mensual</option>
						<option value="90">Trimestral</option>
						<option value="180">Semestral</option>
						<option value="365">Anual</option>
						<option value="0">No vence</option>
					</select>

				</div>

			</div>

			<!-- Button -->
			<div class="control-group">

				<div class="controls">
					<button id="submit" name="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Añadir</button>
				</div>

			</div>

			{{ Form::close() }}

		</div>

	</div>

</div>