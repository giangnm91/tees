<!DOCTYPE html>
<html lang="en-us">
	<head>		
        @include('layout._meta')
		<!-- GOOGLE FONT -->
		<link href='//fonts.googleapis.com/css?family=Roboto:400,300italic,300,400italic,700italic,700&subset=latin,vietnamese' rel='stylesheet' type='text/css'/>
		<!-- Basic Styles -->
        {!! Html::style('assets/css/libs/bootstrap.min.css', array('media' => 'screen')) !!}
        {!! Html::style('assets/css/libs/font-awesome.min.css', array('media' => 'screen')) !!}
        {!! Html::style('assets/css/libs/sweetalert.css', array('media' => 'screen')) !!}
		{!! Html::style('assets/css/auth.min.css', array('media' => 'screen')) !!}	
		@yield('header-script')
	</head>
	<body>
		<header id="header">
			<div id="logo-group">
				<span id="logo"> <a href="{!! URL::to('/admin') !!}"><img class="img-responsive" src="{{URL::asset('images/logoTop.png')}}" alt="@lang('define.base_site_name')" /></a> </span>
            </div>
		</header>
        @yield('content')
        <footer>
        	<p class="text-center text-mutted">Tees CMS &copy;2017</p>
        </footer>
		<!--================================================== -->	
	    <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
	    <script src="//code.jquery.com/jquery.min.js"></script>
		<script> if (!window.jQuery) { document.write('<script src="{{ URL::asset("assets/js/libs/jquery.min.js") !!}"><\/script>');} </script>
		<!-- BOOTSTRAP JS -->
        {!! Html::script('assets/js/libs/bootstrap.min.js') !!}
        {!! Html::script('assets/js/libs/sweetalert.min.js') !!}
        {!! Html::script('assets/js/libs/jquery.blockUI.min.js') !!}
        {!! Html::script('assets/js/backend/auth.js') !!}
        @yield('footer-script')
	</body>
</html>