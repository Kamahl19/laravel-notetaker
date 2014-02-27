@extends('master')

@section('content')

  <div class="main-form">
  
		@if( count($errors) > 0 )
			<div class="alert alert-danger">{{ HTML::ul($errors->all()) }}</div>
		@endif

    {{ Form::open(array('url' => 'notes', 'class' => 'form-horizontal', 'id' => 'create-note' )) }}
    
  		<div class="form-group">               
        {{ Form::label('title', trans('common.title'), array('class' => 'sr-only col-sm-2')) }}
        <div class="col-sm-12">
          {{ Form::text('title', Input::old('title'), array('class' => 'form-control', 'placeholder' => trans('common.title'))) }}
        </div>
  		</div>
  
  		<div class="form-group">
        {{ Form::label('text', trans('common.text'), array('class' => 'sr-only col-sm-2')) }}
        <div class="col-sm-12">
          {{ Form::textarea('text', Input::old('text'), array('class' => 'form-control', 'placeholder' => trans('common.text'), 'rows' => '3')) }}
        </div>
  		</div>

			<div class="form-group">
        {{ Form::label('category', trans('common.category'), array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-4">
          <div class="input-group">
            {{ Form::select('category', $categories_select, Input::old('category'), array('class' => 'form-control')) }}
            <span class="input-group-btn">
              <a class="btn btn-default create-category" href="#" role="button"><span class="fa fa-plus fa-lg"></span></a>
            </span>
          </div>
        </div>

				{{ Form::label('priority', trans('common.priority'), array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-4">
          {{ Form::selectRange('priority', 0, 10, 0, array('class' => 'form-control')) }}
        </div>
  		</div>
            
      <div class="form-group">
        {{ Form::label('deadline', trans('common.deadline'), array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-4">
          {{ Form::text('deadline', Input::old('deadline'), array('class' => 'form-control', 'id' => 'date-picker')) }}   
        </div>
        
        {{ Form::label('url', trans('common.url'), array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-4">
          <div class="input-group">
            {{ Form::text('url', Input::old('url'), array('class' => 'form-control')) }}   
            <span class="input-group-btn">
              <a class="btn btn-default open-url" href="#" role="button"><span class="fa fa-external-link fa-lg"></span></a>
            </span>
          </div>
        </div>
  		</div> 
      
      <div class="form-group">
        {{ Form::label('attachments', trans('common.upload_attachment'), array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-4">
          <button type="button" class="btn btn-default add-attachment"><span class="fa fa-paperclip fa-lg"></span> {{ trans('common.upload') }}</button>
        </div>
        
				{{ Form::label('finished', trans('common.finished'), array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-4">
          <div class="checkbox">
            {{ Form::checkbox('finished', Input::old('finished'), 0) }}
          </div>                  
        </div>
  		</div>
      
      {{ Form::hidden('route', URL::to('/')) }}
      
      {{ Form::submit(trans('common.save'), array('class' => 'btn btn-primary btn-sm')) }} 
      
    {{ Form::close() }}
    
    {{ Form::open(array('url' => 'attachments/store', 'files' => true, 'method' => 'post', 'class' => 'form-horizontal dropzone', 'id' => 'upload-form')) }}
      <div class="fallback">
        <input name="file" type="file" multiple>
      </div>
    {{ Form::close() }}
		    
  </div>   
  
@stop