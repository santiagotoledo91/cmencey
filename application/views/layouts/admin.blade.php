<html>
<head>
	<title> {{ $title }} </title> 

	{{ Asset::styles() }} 

</head>
<body>

	<header>
		
		this is a header

	</header>

	{{ $content }}

	<footer>
		
		this is a footer

	</footer>

	{{ Asset::scripts() }}
	
</body>
</html>