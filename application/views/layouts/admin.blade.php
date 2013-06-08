<!DOCTYPE html>

<html lang="en">

<head>

	<title> {{ $title }} </title> 

	{{ Asset::styles() }} 

</head>

<body>
	
	<!-- START WARP -->
	<div id="wrap">

		<!-- START MAIN -->
		<div id="main">

			<!-- START HEADER -->
			<div class="navbar navbar-static-top" style="margin-bottom:15px;">

				<div class="navbar-inner">

					<div class="container">

						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>

						<a class="brand">Construcciones Mencey, C.A</a>

						<div class="nav-collapse">

							<ul class="nav">

								<li><a href=" {{ URL::to('admin') }} "><i class="icon-home"></i> Resumen</a></li>

								<li class="divider-vertical"></li>

								<li class="dropdown">

									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-briefcase"></i> Tesoreria <b class="caret"></b></a>

									<ul class="dropdown-menu">

										<li>
											<a href="{{ URL::to('admin/paysheets/pre') }}"><i class="icon-plus"></i> Generar nómina</a>
										</li>

										<li>
											<a href="#"><i class="icon-plus"></i> Calcular prestaciones sociales</a>
										</li>

									</ul>

								</li>

								<li class="divider-vertical"></li>

								<li class="dropdown">

									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Personal <b class="caret"></b></a>

									<ul class="dropdown-menu">

										<li>
											<a href="{{ URL::to('admin/employees/add') }}"><i class="icon-plus"></i> Añadir</a>
										</li>

										<li>
											<a href=" {{ URL::to('admin/employees/manage') }} "><i class="icon-cog"></i> Ver - Editar</a>
										</li>

									</ul>

								</li>

								<li class="divider-vertical"></li>

								<li class="dropdown">

									<a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open"></i> Documentos <b class="caret"></b></a>

									<ul class="dropdown-menu">

										<li>
											<a href="{{ URL::to('admin/docs/expired') }}"><i class="icon-exclamation-sign"></i> Vencidos y por vencer</a>
										</li>

										<li>
											<a href="{{ URL::to('admin/docs/pending') }}"><i class="icon-exclamation-sign"></i> Por consignar</a>
										</li>

										<li class="divider"></li>

										<li>
											<a href="{{ URL::to('admin/docs/add') }}"><i class="icon-plus"></i> Nuevo tipo de documento</a>
										</li>

										<li>
											<a href="{{ URL::to('admin/docs/manage') }}"><i class="icon-cog"></i> Editar tipos de documentos</a>
										</li>

									</ul>

								</li>

								<li class="divider-vertical"></li>

								<li class="dropdown">

									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-print"></i> Imprimir <b class="caret"></b></a>

									<ul class="dropdown-menu">

										<li>
											<a href="{{ URL::to('admin/paysheets/list') }}">Nómina</a>
										</li>

										<li>
											<a href="#">Recibos de págo</a>
										</li>

										<li>
											<a href="#">Prestaciones sociales</a>
										</li>

										<li class="divider"></li>

										<li>
											<a href="#">Solvencia A</a>
										</li>

										<li>
											<a href="#">Solvencia B</a>
										</li>

										<li>
											<a href="#">Solvencia C</a>
										</li>

									</ul>

								</li>

							</ul>

							<ul class="nav pull-right">

								<li><a href=" {{ URL::to('admin/logout') }} "><i class="icon-off"></i> Cerrar sesion</a></li>

							</ul>

						</div>	

					</div>

				</div>

			</div>
			<!-- END HEADER -->
			<div id="spacer"></div>
			<!-- START CONTENT -->
				@yield('content')
			<!-- END CONTENT -->

		</div> 
		<!-- END MAIN -->

	</div>
	<!-- END WARP -->

	<!-- START FOOTER -->
	<div id="footer">

		<p>Construcciones Mencey, C.A - Sistema de administracion de personal</p>
		<p>Copyright © Santiago Toledo — Todos los derechos reservados.</p>

	</div>
	<!-- END FOOTER -->

	{{ Asset::scripts() }}

	<script type="text/javascript">  
		$(document).ready(function () {  
			$(".collapse").collapse();
			$(".dropdown-toggle").dropdown();  
		});
	</script>

</body>

</html>