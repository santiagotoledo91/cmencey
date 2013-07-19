@layout('layouts.login')
@section('content')

		<div class="login center" style="width:380px;">

			<div class="white-area white-area-content" style="box-shadow: 0px 0px 20px gray;">
				<div class="text-center ">

					{{ HTML::image('img/logo.png','logo', array('width' => '230')) }} 
					<div class="space1"></div>

				</div>

				<div style="width: 270px; margin-left: auto; margin-right: auto;">

					{{ Form::open('admin/login','POST', array('class' => 'form-horizontal login-form')) }}

						{{ $errors->first('auth','<p style="color: red; text-align:center; margin-bottom:1px;">:message</p>') }}	
						{{ $errors->first('username','<p style="color: red; text-align:center; margin-bottom:1px;">:message</p>') }}	
						<!-- Username input-->
						<input type="text" id="username" name="username" class="input-medium" placeholder="Usuario" required>

						{{ $errors->first('password','<p style="color: red; text-align:center; margin-bottom:1px;">:message</p>') }}	
						<!-- Password input-->
						<input type="password" id="password" name="password"  class="input-medium" placeholder="Contraseña" required>

						<!-- Login button-->
						<button id="submit" name="submit" class="btn btn-primary">Iniciar sesión</button>
						<div class="space1"></div>
					{{ Form::close() }}

				</div>
			</div>
		</div>

@endsection