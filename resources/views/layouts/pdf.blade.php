<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>@yield('title')</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link href="{{ asset('css/report.css') }}" rel="stylesheet" />
	@yield('pdf_style')
</head>
<body>
    @yield('content')
</body>
</html>