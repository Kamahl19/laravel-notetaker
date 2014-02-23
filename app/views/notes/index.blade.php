@extends('master')

@section('content')

  @if( count($notes) > 0 )
    
    @foreach($notes as $key => $note)
  	<div class="list">
  		<h5 class="pull-left">
        <a href="{{ URL::to('notes/' . $note->id . '/edit') }}"><span class="label label-primary">{{ $note->priority }}</span> <strong>{{ $note->title }}</strong></a>
      </h5>
      
      <div class="list-actions pull-right">   
        <a href="{{ URL::to('notes/' . $note->id . '/edit') }}" class="text-muted" title="Upraviť"><span class="fa fa-pencil"></span></a>
				<a href="{{ URL::to('notes/' . $note->id) }}" data-method="delete" data-object="note" class="text-muted" title="Zmazať"><span class="fa fa-trash-o"></span></a>
        @if ( $note->deadline )
          <span class="badge pull-right">{{ $note->deadline }}</span>
        @endif
        <span class="badge pull-right">{{ $note->name }}</span>
        @if ( $note->files_count )
          <span class="badge pull-right"><span class="text-muted fa fa-paperclip"></span> {{ $note->files_count }}</span>
        @endif
        @if ( $note->finished )
          <span class="badge pull-right"><span class="text-muted fa fa-check"></span></span>
        @endif
      </div>
      
      <div class="clearfix"></div>
      
  		<p>{{ Str::words($note->text, 10) }}</p>    
  	</div>
    @endforeach
    
    {{ $notes->links(); }}
    
    <div class="clearfix"></div>
    
  @else
  
    <p class="empty-list"><a href="{{ URL::to('notes/create') }}">Pridajte prvú poznámku</a></p>
    
  @endif
  
@stop