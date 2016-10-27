<?php
  use App\Subject;
  use App\Page;
  $page_count = Page::max('position');
  $subject = Subject::find($id);
?>

@extends('layouts.app')
@section('content')
  <div class="container-fluid">
    <h2>Create Page: belongs to {{ $subject->menu_name }}</h2>
    @foreach ($errors->all() as $error)
        <p class="error error_fonts">{{ $error }}</p>
    @endforeach
    {{ Form::open(['url' => 'page']) }}
    <div class="form-group">
      {{ Form::hidden('subject_id', $id) }}
      <div class="menu_name_textfield">
        {{ Form::label('menu_name', 'Menu Name:', ['class' => 'control-label']) }}
        {{ Form::text('menu_name', '', ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="form-group">
      <div class="select_field">
        {{ Form::label('position', 'Position:', ['class' => 'control-label']) }}
        {{ Form::selectRange('position', 1, $page_count + 1, $page_count + 1, ['class' => 'form-control']) }}
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
    <div class="form-group">
      {{ Form::label('content', 'Comments:', ['class' => 'control-label']) }}
      {{ Form::textarea('content', null, ['size' => '30x5',
                                          'class' => 'form-control',
                                          'placeholder' => 'Write anything you like!']) }}
    </div>
    <div class="form-group submit_group">
      {{ link_to('/manage_content', $title = 'Cancel', ['class' => 'btn btn-info']) }}
      {{ Form::submit('Create Page', ['class' => 'btn btn-success']) }}
    </div>
    {{ Form::close() }}
  </div>
@stop
