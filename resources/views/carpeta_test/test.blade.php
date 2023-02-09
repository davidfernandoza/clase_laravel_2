<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	@vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
	<h1>Hola mundo</h1>
	<div id="app">
		<mi-componente :products="{{$products}}"/>
	</div>
</body>
</html>
