@extends('master')

@section('content')

  <div class="add-note-form">
  
		@if( count($errors) > 0 )
			<div class="alert alert-warning">{{ HTML::ul($errors->all()) }}</div>
		@endif

    {{ Form::open(array('url' => 'notes', 'class' => 'form-horizontal', 'id' => 'create-note' )) }}
    
  		<div class="form-group">
        {{ Form::label('title', 'Názov', array('class' => 'sr-only col-sm-2')) }}
        <div class="col-sm-12">
          {{ Form::text('title', Input::old('title'), array('class' => 'form-control', 'placeholder'=>'Názov')) }}
        </div>
  		</div>
  
  		<div class="form-group">
        {{ Form::label('text', 'Poznámka', array('class' => 'sr-only col-sm-2')) }}
        <div class="col-sm-12">
          {{ Form::textarea('text', Input::old('text'), array('class' => 'form-control', 'placeholder' => 'Text', 'rows'=>'3')) }}
        </div>
  		</div>

			<div class="form-group">
        {{ Form::label('category', 'Kategória', array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-4">
          <div class="input-group">
            {{ Form::select('category', $categories_select, Input::old('category'), array('class' => 'form-control')) }}
            <span class="input-group-btn">
              <a class="btn btn-default create-category" href="#" role="button"><span class="fa fa-plus"></span></a>
            </span>
          </div>
        </div>

				{{ Form::label('priority', 'Priorita', array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-4">
          {{ Form::selectRange('priority', 0, 10, 0, array('class' => 'form-control')) }}
        </div>
  		</div>
            
      <div class="form-group">
        {{ Form::label('deadline', 'Termín', array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-4">
          {{ Form::text('deadline', Input::old('deadline'), array('class' => 'form-control', 'id' => 'date-picker')) }}   
        </div>
        
				{{ Form::label('finished', 'Hotovo', array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-4">
          <div class="checkbox">
            {{ Form::checkbox('finished', Input::old('finished'), 0) }}
          </div>
        </div>
  		</div> 
      
      <div class="form-group">
        {{ Form::label('attachments', 'Nahrať prílohy', array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-4">
          <button type="button" class="btn btn-default add-attachment"><span class="fa fa-paperclip fa-lg"></span> Upload</button>
        </div>
  		</div>           
      
      {{ Form::hidden('route', URL::to('/')) }}
      
      {{ Form::submit('Uložiť', array('class' => 'btn btn-primary btn-sm')) }}
    {{ Form::close() }}
    
    {{ Form::open(array('url' => 'attachments/store', 'files' => true, 'method' => 'post', 'class' => 'form-horizontal dropzone', 'id' => 'upload-form')) }}
    {{ Form::close() }}
		    
  </div>   
  
@stop