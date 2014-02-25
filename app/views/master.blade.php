<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>{{ trans('common.site_title') }}</title>

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
  
  <script type="text/javascript">
    var trans = new Object();
    trans.confirm_delete_note = "{{ trans('common.confirm_delete_note') }}";
    trans.confirm_delete_category = "{{ trans('common.confirm_delete_category') }}";
    trans.del = "{{ trans('common.delete') }}";
    trans.cancel = "{{ trans('common.cancel') }}";
    trans.upload_default_message = "{{ trans('common.upload_default_message') }}";
    trans.confirm_cancel_upload = "{{ trans('common.confirm_cancel_upload') }}";
    trans.upload_file_too_big = "{{ trans('common.upload_file_too_big') }}";
    trans.download = "{{ trans('common.download') }}";
    trans.deadline = "{{ trans('common.deadline') }}";
    trans.time = "{{ trans('common.time') }}";
    trans.hour = "{{ trans('common.hour') }}";
    trans.minute = "{{ trans('common.minute') }}";
    trans.now = "{{ trans('common.now') }}";
    trans.ok = "{{ trans('common.ok') }}";
    trans.date_format = "{{ trans('common.date_format') }}";
    trans.title = "{{ trans('common.title') }}";
    trans.new_category = "{{ trans('common.new_category') }}";
    trans.save = "{{ trans('common.save') }}";
    trans.category_exists_already = "{{ trans('common.category_exists_already') }}";
    trans.create_category_error = "{{ trans('common.create_category_error') }}";
  </script>
</head>
  
<body>
  <!--[if lt IE 8]>
    <p class="browsehappy"><span class="fa fa-exclamation-circle fa-lg"></span> {{ trans('common.browse_happy') }} <span class="fa fa-exclamation-circle fa-lg"></span></p>
  <![endif]-->

  <div class="container-fluid">
  
    <div class="header">
      <nav class="navbar navbar-default" role="navigation">  
        <div class="container-fluid">
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