<ul class="nav navbar-nav navbar-right">
  <li {{ Request::is('notes/create') ? 'class="active"' : '' }}><a href="{{ URL::to('notes/create') }}"><span class="fa fa-plus"></span> Pridať poznámku</a></li>
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