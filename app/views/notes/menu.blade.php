<ul class="nav navbar-nav navbar-right">
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
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-sort"></span> {{ trans('common.order') }}</a>
    <ul class="dropdown-menu">
      <li><a href="#"><span class="fa fa-sort-alpha-asc"></span> {{ trans('common.title') }}</a></li>
      <li><a href="#"><span class="fa fa-sort-alpha-desc"></span> {{ trans('common.title') }}</a></li>
      <li><a href="#"><span class="fa fa-sort-numeric-desc"></span> {{ trans('common.priority') }}</a></li>
      <li><a href="#"><span class="fa fa-sort-numeric-asc"></span> {{ trans('common.priority') }}</a></li>
      <li><a href="#"><span class="fa fa-frown-o"></span> {{ trans('common.order_deadline_asc') }}</a></li>
      <li><a href="#"><span class="fa fa-smile-o"></span> {{ trans('common.order_deadline_desc') }}</a></li>
      <li><a href="#"><span class="fa fa-calendar-o"></span> {{ trans('common.order_time_asc') }}</a></li>
      <li><a href="#"><span class="fa fa-calendar-o"></span> {{ trans('common.order_time_desc') }}</a></li>
    </ul>
  </li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-filter"></span> {{ trans('common.filter') }}</a>
    <ul class="dropdown-menu">
      <li><a href="#"><span class="fa fa-check-square-o"></span> {{ trans('common.filter_only_finished') }}</a></li>
      <li><a href="#"><span class="fa fa-cloud-download"></span> {{ trans('common.filter_only_with_attachment') }}</a></li>
    </ul>
  </li>
  <li {{ Request::is('settings') ? 'class="active"' : '' }}><a href="#"><span class="fa fa-cog"></span> {{ trans('common.settings') }}</a></li>
</ul>       