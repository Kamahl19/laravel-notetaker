<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Plánovač</title>

  {{ HTML::style('css/bootstrap-yeti.min.css'); }}
  {{ HTML::style('css/font-awesome.min.css'); }}  
  {{ HTML::style('css/jquery-ui.css'); }}  
  {{ HTML::style('css/bootstrap-dialog.min.css'); }}
  {{ HTML::style('css/dropzone.css');}}
  {{ HTML::style('css/style.css'); }}
	
  {{ HTML::script('js/jquery.min.js'); }}
  {{ HTML::script('js/jquery-ui.min.js'); }}
  {{ HTML::script('js/bootstrap.min.js'); }}
  {{ HTML::script('js/jquery-ui-timepicker-addon.js'); }}
  {{ HTML::script('js/bootstrap-dialog.min.js'); }}
  {{ HTML::script('js/dropzone.js') }}
  {{ HTML::script('js/my-js.js'); }}
  
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
  
<body>
  <!--[if lt IE 8]>
    <p class="browsehappy"><span class="fa fa-exclamation-circle fa-lg"></span> Používate zastaralý internetový prehliadač. <a href="http://browsehappy.com/"><strong>Odporúčame vám ho <strong>updatovať</strong></a> <span class="fa fa-exclamation-circle fa-lg"></span></p>
  <![endif]-->

  <div class="container-fluid">
  
    <div class="header">
      <nav class="navbar navbar-default" role="navigation">  
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top_menu">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::to('notes') }}"><span class="fa fa-home"></span> Plánovač</a>
          </div>
      
          <div class="collapse navbar-collapse" id="top_menu">
            @if (Request::segment(1) == 'notes')
              @include('notes.menu')
            @elseif (Request::segment(1) == 'categories')
              @include('categories.menu')
            @endif
          </div>
        </div>
      </nav>                       
    </div>
    
		<div class="content">
	    @if (Session::has('message'))
	    	<div class="alert alert-info">{{ Session::get('message') }}</div>
	    @endif

	    @yield('content')
		</div>
    
    <div class="footer">
      <p>&copy; 2014 <a href="mailto:kamahl19@gmail.com">Martin Litvaj</a></p>
    </div>
  
  </div>
</body>  
</html>