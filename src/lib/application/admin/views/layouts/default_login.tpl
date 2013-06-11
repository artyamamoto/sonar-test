<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<title>管理画面 | {{$config->system->sitename}}</title>

		<link rel="stylesheet" href="{{$request->getBaseUrl()}}/css/reset.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="{{$request->getBaseUrl()}}/css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="{{$request->getBaseUrl()}}/css/invalid.css" type="text/css" media="screen" />	

		<!-- Internet Explorer Fixes Stylesheet -->

		<!--[if lte IE 7]>
			<link rel="stylesheet" href="{{$request->getBaseUrl()}}/css/ie.css" type="text/css" media="screen" />
		<![endif]-->

		<!-- jQuery -->
		<script type="text/javascript" src="{{$request->getBaseUrl()}}/scripts/jquery-1.3.2.min.js"></script>

		<!-- jQuery Configuration -->
		<script type="text/javascript" src="{{$request->getBaseUrl()}}/scripts/simpla.jquery.configuration.js"></script>

		<!-- Facebox jQuery Plugin -->
		<script type="text/javascript" src="{{$request->getBaseUrl()}}/scripts/facebox.js"></script>

		<!-- Internet Explorer .png-fix -->

		<!--[if IE 6]>
			<script type="text/javascript" src="{{$request->getBaseUrl()}}/scripts/DD_belatedPNG_0.0.7a.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<![endif]-->
	</head>

    <body id="login">
        {{$layout.content|smarty:nodefaults}}
    </body>
  
</html>
