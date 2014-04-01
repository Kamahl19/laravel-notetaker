<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>{{ trans('common.site_title') }}</title>           

  {{ HTML::style('vendor/css/bootstrap-yeti.min.css'); }}
  {{ HTML::style('vendor/css/font-awesome.min.css'); }}  
  {{ HTML::style('vendor/css/jquery-ui.min.css'); }}  
  {{ HTML::style('vendor/css/bootstrap-dialog.min.css'); }}
  {{ HTML::style('vendor/css/dropzone.min.css');}}
  {{ HTML::style('css/style.css'); }}
	
  {{ HTML::script('vendor/js/jquery.min.js'); }}
  {{ HTML::script('vendor/js/jquery-ui.min.js'); }}
  {{ HTML::script('vendor/js/bootstrap.min.js'); }}
  {{ HTML::script('vendor/js/jquery-ui-timepicker-addon.min.js'); }}
  {{ HTML::script('vendor/js/bootstrap-dialog.min.js'); }}
  {{ HTML::script('vendor/js/dropzone.min.js') }}
  {{ HTML::script('vendor/js/bootstrap-notify.js') }}
  {{ HTML::script('js/my-js.js'); }}
  
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <script type="text/javascript">
    var trans = new Object();
    trans.confirm_delete_note     = "{{ trans('common.confirm_delete_note') }}";
    trans.confirm_delete_category = "{{ trans('common.confirm_delete_category') }}";
    trans.del                     = "{{ trans('common.delete') }}";
    trans.cancel                  = "{{ trans('common.cancel') }}";
    trans.upload_default_message  = "{{ trans('common.upload_default_message') }}";
    trans.confirm_cancel_upload   = "{{ trans('common.confirm_cancel_upload') }}";
    trans.upload_file_too_big     = "{{ trans('common.upload_file_too_big') }}";
    trans.download                = "{{ trans('common.download') }}";
    trans.deadline                = "{{ trans('common.deadline') }}";
    trans.time                    = "{{ trans('common.time') }}";
    trans.hour                    = "{{ trans('common.hour') }}";
    trans.minute                  =  "{{ trans('common.minute') }}";
    trans.now                     = "{{ trans('common.now') }}";
    trans.ok                      = "{{ trans('common.ok') }}";
    trans.date_format             = "{{ trans('common.date_format') }}";
    trans.title                   = "{{ trans('common.title') }}";
    trans.new_category            = "{{ trans('common.new_category') }}";
    trans.save                    = "{{ trans('common.save') }}";
    trans.category_exists_already = "{{ trans('common.category_exists_already') }}";
    trans.create_category_error   = "{{ trans('common.create_category_error') }}";
  </script>
</head>
  
<body>
  <!--[if lt IE 8]>
    <p class="browsehappy">{{ trans('common.browse_happy') }}</p>
  <![endif]-->

  <div class="container-fluid">
  
    <div class="header">
      <nav class="navbar navbar-default" role="navigation">  
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top_menu">
            <span class="sr-only">{{ trans('common.toggle_navigation') }}</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ URL::to('notes') }}"><span class="fa fa-home"></span> {{ trans('common.site_title') }}</a>
        </div>
    
        <div class="collapse navbar-collapse" id="top_menu">
          <ul class="nav navbar-nav navbar-right">    
            @if ( ! Auth::guest() )
              @if (Request::segment(1) == 'notes')
                <li {{ Request::is('notes/create') ? 'class="active"' : '' }}><a href="{{ URL::to('notes/create') }}"><span class="fa fa-plus"></span> {{ trans('common.add_note') }}</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-folder"></span> {{ trans('common.categories') }}</a>
                  <ul class="dropdown-menu">
                    @foreach($categories as $key => $category)
                      <li><a href="{{ $category->id }}"><span class="badge">{{ $category->notes }}</span> {{ $category->name }}</a></li>
                    @endforeach
                    <li><a href="{{ URL::to('categories') }}"><span class="fa fa-wrench"></span> {{ trans('common.manage_categories') }}</a></li>
                  </ul>
                </li>
              @elseif (Request::segment(1) == 'categories')
                <li {{ Request::is('categories/create') ? 'class="active"' : '' }}><a href="{{ URL::to('categories/create') }}"><span class="fa fa-plus"></span> {{ trans('common.add_category') }}</a></li>
                <li><a href="{{ URL::to('notes') }}"><span class="fa fa-list"></span> {{ trans('common.notes') }}</a></li>
              @elseif (Request::segment(1) == 'user')
                
              @endif
                <li {{ Request::is('team/create') ? 'class="active"' : '' }}><a href="{{ URL::to('team/create') }}"><span class="fa fa-plus"></span> {{ trans('common.add_team') }}</a></li>
                <li {{ Request::is('user/settings') ? 'class="active"' : '' }}><a href="{{ URL::to('user/settings') }}"><span class="fa fa-cog"></span> {{ trans('common.settings') }}</a></li>
                <li {{ Request::is('user/logout') ? 'class="active"' : '' }}><a href="{{ URL::to('user/logout') }}"><span class="fa fa-power-off"></span> {{ trans('confide::confide.logout') }}</a></li>
            @else
              <!-- <li {{ Request::is('user/login') ? 'class="active"' : '' }}><a href="{{ URL::to('user/login') }}"><span class="fa fa-key"></span> {{ trans('confide::confide.login.title') }}</a></li> -->
              <li {{ Request::is('user/create') ? 'class="active"' : '' }}><a href="{{ URL::to('user/create') }}"><span class="fa fa-sign-in"></span> {{ trans('confide::confide.signup.title') }}</a></li>
            @endif
          </ul>
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
    	<!-- <div class="notifications bottom-left"></div> -->
      <p>&copy; 2014 <a href="mailto:kamahl19@gmail.com">Martin Litvaj</a></p>
    </div>
  
  </div>
</body>  
</html>