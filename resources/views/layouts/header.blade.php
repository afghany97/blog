<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../../../favicon.ico">

	<title>{{config('app.name')}}</title>

	<!-- Bootstrap core CSS -->
	<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="{{asset('css/blog.css')}}" rel="stylesheet">
</head>

<body>

	<header>
		<div class="blog-masthead">
			<div class="container">
				<nav class="nav">
					<a class="nav-link active" href="/">Home</a>
					<a class="nav-link" href="#">New features</a>
					<a class="nav-link" href="#">Press</a>
					<a class="nav-link" href="#">New hires</a>
					<a class="nav-link" href="#">About</a>
					@if(! \Auth::check())
					<a class="nav-link" href="/login">login</a>
					<a class="nav-link" href="/register">register</a>
					@endif
					@if(\Auth::check())
					<a class="nav-link" href="#"> {{\Auth::user()->name}} </a>
					<a class="nav-link" href="/logout">logout</a>
					@endif
				</nav>
			</div>
		</div>

		<div class="blog-header">
			<div class="container">
				<h1 class="blog-title">The Bootstrap Blog</h1>
				<p class="lead blog-description">An example blog template built with Bootstrap.</p>
			</div>
		</div>
	</header>

	<main role="main" class="container">
		<div class="">