@layout('layouts.print')
@section('content')

			<div class="centered">
				{{HTML::image('img/logo.png','logo',array('width' => '230px'));}}
			</div>
			
			<div class="space"></div>
			
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>

			<h5 class="centered"> CONSTANCIA DE TRABAJO</h5>		
						
			<div class="space"></div>
			
			<br>
			<br>
			<br>
			
			<div style="text-align:justify; padding: 0px 90px 0px 90px; line-height: 40px;">
				<p >Por medio de la presente hacemos constar que el ciudadano: {{ $employee->fullname }}, portador de la cédula de identidad N˚ {{$employee->pin}}, labora en nuestra empresa desde {{$employee->startdate}}, desempeñandose como {{$employee->role}}, devegando un salario básico de Bs. {{$employee->salary * 30 }}, mas los beneficios de la ley Orgánica del Trabajo.</p>
				<div class="space"></div>
				<p>Constancia que se expide a petición de la parte interesada al {{ date('d-m-Y') }}.</p>
			</div>
			
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			
			<div style="text-align:center">
				<p>Wilfredo Montenegro</p>
				<p>Asesor legal</p>
				<p>Telefono: 0424-370.95.60</p>
			</div>
@endsection