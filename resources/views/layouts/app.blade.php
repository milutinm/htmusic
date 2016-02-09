<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/favicon.png">

    <title>HT Music</title>

    <link href="{{ elixir("css/all.css") }}" rel="stylesheet">
    <link href="{{ elixir("css/app.css") }}" rel="stylesheet">

	 <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

	<!-- JavaScripts -->
	{{--<script src="{{ elixir('js/app.js') }}"></script>--}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<script src="{{ elixir("js/all.js") }}"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">HT Music</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
				<li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">{{ trans('htmusic.homepage') }}</a></li>
				<li class="{{ Request::is('artist*') ? 'active' : '' }}">{{ Html::linkRoute('artist.index', trans('htmusic.artists')) }}</li>
				<li class="{{ Request::is('release*') ? 'active' : '' }}">{{ Html::linkRoute('release.index', trans('htmusic.releases')) }}</li>
				<li class="{{ Request::is('track*') ? 'active' : '' }}">{{ Html::linkRoute('track.index', trans('htmusic.tracks')) }}</li>
				<li class="{{ Request::is('link*') ? 'active' : '' }}">{{ Html::linkRoute('link.index', trans('htmusic.link')) }}</li>
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
	 <!-- Main jumbotron for a primary marketing message or call to action -->
    {{--<div class="jumbotron">--}}
        {{--<div class="container">--}}
            {{--<h1>Hello, world!</h1>--}}
            {{--<p>This is a template for a simple marketing or informational--}}
                {{--website. It includes a large callout called a jumbotron and three--}}
                {{--supporting pieces of content. Use it as a starting point to create--}}
                {{--something more unique.</p>--}}
            {{--<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>--}}
        {{--</div>--}}
    {{--</div>--}}

	@if ($errors->any())
    <div class="alert alert-danger">
		<strong>{{ trans('htmusic.error') }}</strong>
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
	@endif

	@if (Session::has('alert-danger'))
    <div class="alert alert-danger">
		<strong>{{ trans('htmusic.warning') }}</strong>
        <ul>@foreach (Session::get('alert-danger') as $row)<li>{{ $row }}</li>@endforeach</ul>
    </div>
	@endif

	@if (Session::has('alert-success'))
    <div class="alert alert-success">
		<strong>{{ trans('htmusic.success') }}</strong>
		<ul>@foreach (Session::get('alert-success') as $row)<li>{{ $row }}</li>@endforeach</ul>
    </div>
	@endif

	@if (Session::has('alert-info'))
    <div class="alert alert-info">
		<strong>{{ trans('htmusic.info') }}</strong>
        <ul>@foreach (Session::get('alert-info') as $row)<li>{{ $row }}</li>@endforeach</ul>
    </div>
	@endif

    @yield('content')

    <div class="container">
        <hr />
        <footer>
            <p>© {{ \Carbon\Carbon::today()->year }} HT Music</p>
        </footer>
    </div>

</body>

</html>