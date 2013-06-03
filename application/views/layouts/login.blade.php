<html>
<head>
	<title> {{ $title }} </title>
	
	{{ Asset::styles() }} 

</head>
<body>
	
	@yield('content')

</body>
</html>