<ul class="nav navbar-nav navbar-right">
  <li {{ Request::is('categories/create') ? 'class="active"' : '' }}><a href="{{ URL::to('categories/create') }}"><span class="fa fa-plus"></span> {{ trans('common.add_category') }}</a></li>
  <li><a href="{{ URL::to('notes') }}"><span class="fa fa-list"></span> {{ trans('common.notes') }}</a></li>
  <li {{ Request::is('settings') ? 'class="active"' : '' }}><a href="#"><span class="fa fa-cog"></span> {{ trans('common.settings') }}</a></li>
</ul> 
