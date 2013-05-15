<div class="container-fluid" style="margin-top: 100px">

	<div class="row-fluid">

		<div class="span10 offset1 ">

			<legend>Nuevo empleado</legend>

		</div>

	</div>

	<div class="row-fluid">

	{{ Form::open('admin/employees/add','POST', array('class' => 'form-horizontal')) }}

		<div class="span5 offset1">

			<div class="control-group">

				<label class="control-label">Cargo</label>

				<div class="controls">

					<select id="rol" name="rol" class="input-xlarge span10">

						@foreach ($roles as $rol) 

							<option value = " {{ $rol->id }} "> {{ $rol->name  }} </option>

						@endforeach

					</select>

				</div>

			</div>

			<div class="control-group">

				<label class="control-label">Cédula de identidad</label>

				<div class="controls">

					<input id="pin" name="pin" type="text" placeholder="Ej: 15257593" maxlength="8" class="span10" required>

				</div>

			</div>

			<div class="control-group">

				<label class="control-label">Nombres</label>

				<div class="controls">

					<input id="firstnames" name="firstnames" type="text" maxlength="100" class="span10" required>

				</div>

			</div>

			<div class="control-group">

				<label class="control-label">Apellidos</label>

				<div class="controls">

					<input id="lastnames" name="lastnames" type="text" maxlength="100" class="span10" required>

				</div>

			</div>

			<div class="control-group">

				<label class="control-label">Teléfono</label>

				<div class="controls">

					<input id="phone" name="phone" type="text" placeholder="Ej: 04241235565" class="span10" required>

				</div>

			</div>

		</div>

		<div class="span5">

			<div class="control-group">

				<label class="control-label">Dirección</label>

				<div class="controls">

					<textarea id="address" name="address" class="span10" required></textarea>

				</div>

			</div>

			<div class="control-group">

				<label class="control-label">Documentos a consignar</label>


				<div class="controls">

					<div class="span10" style="height:170px; overflow:auto;">

						@foreach ($documents as $document)

						<label class="checkbox">

						<input type="checkbox" name="required_documents[]" value=" {{ $document-> id }} " checked="checked">

						{{ $document->name }}

						</label>

						@endforeach

					</div>

				</div>

			</div>

		</div>

	</div>	

	<div class="row-fluid" style="padding-top: 20px">

		<div class="span2 offset5">

			<div class="control-group">

				<div class="controls">

					<button id="submit" name="submit" class="btn btn-primary btn-block"><i class="icon-ok icon-white"></i> Añadir empleado</button>

				</div>

			</div>

		</div>

	{{ Form::close() }}

	</div>

</div>

