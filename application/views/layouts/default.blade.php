<html>
<head>
	<title> {{ $title }} </title> 
	
	{{ HTML::style('css/bootstrap.css')}}
	{{ HTML::style('css/bootstrap-responsive.css')}}

	{{ HTML::script('js/bootstrap.js')}}

</head>
<body>
	{{ $header }}
	{{ $content }}
	{{ $footer }}
</body>
</html>