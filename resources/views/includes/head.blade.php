<!-- Meta, title, CSS, favicons, etc. -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title> @hasSection ('title') @yield('title') - GDigital @else {{ config('app.name', 'GDigital') }}  @endif </title>
@section('head.css')
	<!-- Styles -->
    <!-- Bootstrap -->
    <link href="/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="/vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- jQuery custom content scroller -->
	<link href="/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>	
 @show
 @stack('header.page.level.style')
 <!-- Custom Theme Style -->
<link href="/css/custom.min.css" rel="stylesheet">
<link href="/css/override.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="/assets/js/ie8-responsive-file-warning.js"></script>
<![endif]-->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- Scripts -->
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
@stack('header.page.level.scripts')