@extends('master')

@section('content')

  @if( count($notes) > 0 )
    <ul>
    <ul class="nav nav-pills">  
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
    </ul>
  
    <div class="items">
      @foreach($notes as $key => $note)
    	<div class="list-item">
        <div class="list-actions pull-right">   
          <a href="{{ URL::to('notes/' . $note->id . '/edit') }}" class="text-muted" title="{{ trans('common.edit') }}"><span class="fa fa-pencil"></span></a>
  				<a href="{{ URL::to('notes/' . $note->id) }}" data-method="delete" data-object="note" class="text-muted" title="{{ trans('common.delete') }}"><span class="fa fa-trash-o"></span></a>
          @if ( $note->finished )
            <span class="badge" title="{{ trans('common.finished') }}"><span class="text-muted fa fa-check"></span></span>
          @endif
          @if ( $note->url )
            <span class="badge" title="{{ trans('common.url') }}"><span class="text-muted fa fa-link"></span></span>
          @endif
          @if ( $note->files_count )
            <span class="badge" title="{{ trans('common.attachment') }}"><span class="text-muted fa fa-paperclip"></span> {{ $note->files_count }}</span>
          @endif 
          <span class="badge" title="{{ trans('common.category') }}">{{ $note->name }}</span>
          @if ( $note->deadline )
            <span class="badge" title="{{ trans('common.deadline') }}">{{ $note->deadline }}</span>
          @endif
        </div>
        
        <h5>
          <a href="{{ URL::to('notes/' . $note->id . '/edit') }}"><span class="label label-primary">{{ $note->priority }}</span> <strong>{{ $note->title }}</strong></a>
        </h5>
        
    		<p>{{ Str::words($note->text, 10) }}</p>    
    	</div>
      @endforeach
    </div>
    
    {{ $notes->links(); }}
    
    <div class="clearfix"></div>
    
  @else
  
    <p class="empty-list"><a href="{{ URL::to('notes/create') }}">{{ trans('common.create_first_note') }}</a></p>
    
  @endif
  
@stop