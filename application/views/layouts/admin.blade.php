<!DOCTYPE html>

<html lang="en">

<head>

	<title> {{ $title }} </title> 

	{{ Asset::styles() }} 

</head>

<body>

	<!-- START HEADER -->
	<header>

		<div class="navbar">

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

							<li><a href=" {{ URL::to('admin') }} "><i class="icon-home"></i> Inicio</a></li>

							<li class="divider-vertical"></li>

							<li class="dropdown">

								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-briefcase"></i> Tesoreria <b class="caret"></b></a>

								<ul class="dropdown-menu">

									<li>
										<a href="#">Nómina</a>
									</li>

									<li>
										<a href="#">Prestaciones sociales</a>
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
										<a href=" {{ URL::to('admin/employees') }} "><i class="icon-cog"></i> Gestionar</a>
									</li>

								</ul>

							</li>

							<li class="divider-vertical"></li>

							<li class="dropdown">

								<a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open"></i> Documentos <b class="caret"></b></a>

								<ul class="dropdown-menu">

									<li>
										<a href="{{ URL::to('admin/docs/pending') }}"><i class="icon-exclamation-sign"></i> Pendientes</a>
									</li>

									<li class="divider"></li>

									<li>
										<a href="{{ URL::to('admin/docs/add') }}"><i class="icon-plus"></i> Añadir</a>
									</li>

									<li>
										<a href="{{ URL::to('admin/docs') }}"><i class="icon-cog"></i> Gestionar</a>
									</li>

								</ul>

							</li>

							<li class="divider-vertical"></li>

							<li class="dropdown">

								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-print"></i> Imprimir <b class="caret"></b></a>

								<ul class="dropdown-menu">

									<li>
										<a href="#">Nómina</a>
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

	</header>
	<!-- END HEADER -->

	<!-- START CONTENT -->
	{{ $content }}
	<!-- END CONTENT -->

	<!-- START FOOTER -->
	<footer>

		this is a footer

	</footer>
	<!-- END FOOTER -->

	{{ Asset::scripts() }}

	<script type="text/javascript">  
		$(document).ready(function () {  
			$(".collapse").collapse();
			$(".dropdown-toggle").dropdown();  
			$(".tooltip").tooltip()
		});
	</script>

</body>

</html>