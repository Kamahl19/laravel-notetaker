<ul class="nav navbar-nav navbar-right">
  <li {{ Request::is('categories/create') ? 'class="active"' : '' }}><a href="{{ URL::to('categories/create') }}"><span class="fa fa-plus"></span> Pridať kategóriu</a></li>
  <li><a href="{{ URL::to('notes') }}"><span class="fa fa-list"></span> Poznámky</a></li>
  <li {{ Request::is('settings') ? 'class="active"' : '' }}><a href="#"><span class="fa fa-cog"></span> Nastavenia</a></li>
</ul> 
