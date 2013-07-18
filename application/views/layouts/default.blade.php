<html>
<head>
	<title> {{ $title }} </title> 
	
	{{ Asset::styles() }} 

	<link rel="shortcut icon" href="favicon.ico" /> 

</head>
<body>
	
	<header>
		
		this is a header

	</header>

	@yield('content')

	<footer>

		this is a footer

	</footer>

	{{ Asset::scripts() }}

</body>
</html>