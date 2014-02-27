@extends('master')

@section('content')

  @if( count($notes) > 0 )
  
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