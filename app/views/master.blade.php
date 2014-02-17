<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Plánovač</title>

  {{ HTML::style('css/bootstrap-yeti.min.css'); }}
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
  <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
  {{ HTML::style('css/bootstrap-dialog.min.css'); }}
  {{ HTML::style('css/style.css'); }}
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  {{ HTML::script('js/jquery-ui-timepicker-addon.js'); }}
  {{ HTML::script('js/bootstrap-dialog.min.js'); }}
  {{ HTML::script('js/my_js.js'); }}
</head>
  
<body>
  <div class="container-fluid">
  
    <div class="header">
      <nav class="navbar navbar-default" role="navigation">  
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::to('notes') }}"><span class="fa fa-home"></span> Plánovač</a>
          </div>
      
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li {{ Request::is('notes/create') ? 'class="active"' : '' }}><a href="{{ URL::to('notes/create') }}"><span class="fa fa-plus"></span> Pridať</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-folder"></span> Kategórie</a>
                <ul class="dropdown-menu">
                  @foreach($categories as $key => $category)
                    <li><a href="{{ $category->id }}"><span class="badge">{{ $category->notes }}</span> {{ $category->name }}</a></li>
                  @endforeach
                  <li><a href="{{ URL::to('categories') }}"><span class="fa fa-wrench"></span> Upraviť kategórie</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-sort"></span> Zoradiť</a>
                <ul class="dropdown-menu">
                  <li><a href="#"><span class="fa fa-sort-alpha-asc"></span> Nadpis</a></li>
                  <li><a href="#"><span class="fa fa-sort-alpha-desc"></span> Nadpis</a></li>
                  <li><a href="#"><span class="fa fa-sort-numeric-desc"></span> Priorita</a></li>
                  <li><a href="#"><span class="fa fa-sort-numeric-asc"></span> Priorita</a></li>
                  <li><a href="#"><span class="fa fa-frown-o"></span> Najbližší termín</a></li>
                  <li><a href="#"><span class="fa fa-smile-o"></span> Najneskorší termín</a></li>
                  <li><a href="#"><span class="fa fa-calendar-o"></span> Najnovšie prvé</a></li>
                  <li><a href="#"><span class="fa fa-calendar-o"></span> Najstaršie prvé</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-filter"></span> Filter</a>
                <ul class="dropdown-menu">
                  <li><a href="#"><span class="fa fa-check-square-o"></span> Len hotové</a></li>
                  <li><a href="#"><span class="fa fa-cloud-download"></span> Len s prílohou</a></li>
                </ul>
              </li>
              <li {{ Request::is('settings') ? 'class="active"' : '' }}><a href="#"><span class="fa fa-cog"></span> Nastavenia</a></li>
            </ul>       
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