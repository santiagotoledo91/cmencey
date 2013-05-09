<div class="container-fluid" style="margin-top: 200px">

	<div class="row-fluid">

		<div class="span4 offset4">

			{{ Form::open('admin/login','POST', array('class' => 'form-horizontal')) }}

			<div id="legend">

				<h3 class="text-center"> Construcciones Mencey, C.A.</h3>
				
				<legend class="text-center">Sistema de gestión de personal.</legend>

			</div>

			<div class="control-group">

				<label class="control-label" for="username">Usuario</label>

				<div class="controls">

					<input type="text" name="username" id="username">

				</div>

			</div>

			<div class="control-group">

				<label for="password" class="control-label">Contrase&ntilde;a</label>

				<div class="controls">

					<input type="password" name="password" id="password">

				</div>

			</div>

			<div class="control-group">

				<div class="controls">

					<button class="btn btn-primary" type="submit" value="Iniciar sesion"><i class="icon-share-alt icon-white"></i> Iniciar Sesión</a></button>

				</div>

			</div>

			{{ Form::close() }}

		</div>

	</div>

</div>