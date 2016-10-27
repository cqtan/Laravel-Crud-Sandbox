<?php
  use App\Subject;
  $subject_count = Subject::max('position');
?>

@extends('layouts.app')
@section('content')
  <div class="container-fluid">
    <h2>Create Subject</h2>
    @foreach ($errors->all() as $error)
        <p class="error error_fonts">{{ $error }}</p>
    @endforeach
    {{ Form::open(['url' => 'subject']) }}
    <div class="form-group">
      <div class="menu_name_textfield">
        {{ Form::label('menu_name', 'Menu Name:', ['class' => 'control-label']) }}
        {{ Form::text('menu_name', '', ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="form-group">
      <div class="select_field">
        {{ Form::label('position', 'Position:', ['class' => 'control-label']) }}
        {{ Form::selectRange('position', 1, $subject_count + 1, $subject_count + 1, ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('visible', 'Visible:', ['class' => 'control-label']) }}
      <div class="radio">
        <label>
          {{ Form::radio('visible', 1, true) }}
          True
        </label>
      </div>
      <div class="radio">
        <label>
          {{ Form::radio('visible', 0) }}
          False
        </label>
      </div>
    </div>
    <div class="form-group submit_group">
      {{ link_to('/manage_content', $title = 'Cancel', ['class' => 'btn btn-info']) }}
      {{ Form::submit('Create Subject', ['class' => 'btn btn-success']) }}
    </div>
    {{ Form::close() }}
  </div>
@stop
