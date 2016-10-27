<?php
  use App\Subject;
  $subject = Subject::find($page->subject_id);
?>

@extends('layouts.app')
@section('content')
  <div class="container-fluid">
    <h2>Showing Page: belongs to {{ $subject->menu_name }}</h2>
    @foreach ($errors->all() as $error)
        <p class="error error_fonts">{{ $error }}</p>
    @endforeach
    {{ Form::open(['url' => 'page']) }}
      <div class="menu_name_textfield">
        {{ Form::label('menu_name', 'Menu Name:', ['class' => 'control-label']) }}
        {{ Form::text('menu_name', $page->menu_name, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>
    <div class="form-group">
      <div class="select_field">
        {{ Form::label('position', 'Position:', ['class' => 'control-label']) }}
        {{ Form::selectRange('position', 1, $page->position, $page->position, ['class' => 'form-control',
                                                                               'disabled' => 'disabled']) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('visible', 'Visible:', ['class' => 'control-label']) }}
      <div class="radio">
        <label>
          {{ Form::radio('visible', 1, true, ['disabled' => 'disabled']) }}
          True
        </label>
      </div>
      <div class="radio">
        <label>
          {{ Form::radio('visible', 0, ['disabled' => 'disabled']) }}
          False
        </label>
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('content', 'Comments:', ['class' => 'control-label']) }}
      {{ Form::textarea('content', null, ['size' => '30x5',
                                          'class' => 'form-control',
                                          'placeholder' => 'Write anything you like!',
                                          'disabled' => 'disabled']) }}
    </div>
    <div class="form-group submit_group">
      {{ link_to('/manage_content', $title = 'Return', ['class' => 'btn btn-info']) }}
      <a href="/page/{{$page->id}}/edit" >
        <button type="button" name="button"class="btn btn-info">
          <span class="glyphicon glyphicon-pencil"></span> Edit Page</button>
      </a>
      {{ Form::open(['route' => ['subject.destroy', $subject->id], 'method' => 'delete']) }}
        <button type="submit" class="btn btn-danger">
          <span class="glyphicon glyphicon-remove"></span> Delete</button>
      {{ Form::close() }}
    </div>
    {{ Form::close() }}
  </div>
@stop
