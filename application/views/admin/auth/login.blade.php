@layout('layouts.login')
@section('content')

		<div class="login center">

			<div class="white-area white-area-content">
				<div class="text-center ">

					{{ HTML::image('img/logo.png','logo', array('width' => '230')) }} 
					<div class="space1"></div>

				</div>

				<div style="width: 270px; margin-left: auto; margin-right: auto;">

					{{ Form::open('admin/login','POST', array('class' => 'form-horizontal login-form')) }}

						{{ $errors->first('username', 	'<div class="alert alert-error text-center">:message</div>') }}
						{{ $errors->first('password', 	'<div class="alert alert-error text-center">:message</div>') }}
						{{ $errors->first('auth'	, 	'<div class="alert alert-error text-center">:message</div>') }}

						<!-- Username input-->
						<input type="text" id="username" name="username" class="input-medium" placeholder="Usuario" required>

						<!-- Password input-->
						<input type="password" id="password" name="password"  class="input-medium" placeholder="Contrasena" required>

						<!-- Login button-->
						<button id="submit" name="submit" class="btn btn-primary">Iniciar sesion</button>
						<div class="space1"></div>
					{{ Form::close() }}

				</div>
			</div>
		</div>

@endsection