<?php
  use App\Subject;
  $subject = Subject::find($page->subject_id);
  $all_subjects = Subject::all()->sortBy("position");
?>

@extends('layouts.app')
@section('content')
  <div class="container-fluid">
    <h2>Showing Page: belongs to {{ $subject->menu_name }}</h2>
    @foreach ($errors->all() as $error)
        <p class="error error_fonts">{{ $error }}</p>
    @endforeach
    {{ Form::open(['route' => ['page.update', $page->id], 'method' => 'PATCH']) }}
    <div class="form-group">
      <div class="select_subject">
        <label for="subject">Subject:</label>
        <select class="form-control" id="subject" value="{{$subject->menu_name}}" name="subject">
          @foreach ($all_subjects as $subjects)
            @if ($subjects->menu_name == $subject->menu_name)
              <option selected>{{$subjects->menu_name}}</option>
            @endif
            <option>{{$subjects->menu_name}}</option>
          @endforeach
        </select>
      </div>
    </div>
      <div class="menu_name_textfield">
        {{ Form::label('menu_name', 'Menu Name:', ['class' => 'control-label']) }}
        {{ Form::text('menu_name', $page->menu_name, ['class' => 'form-control']) }}
      </div>
    <div class="form-group">
      <div class="select_field">
        {{ Form::label('position', 'Position:', ['class' => 'control-label']) }}
        {{ Form::selectRange('position', 1, $page->position, $page->position, ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('visible', 'Visible:', ['class' => 'control-label']) }}
      <div class="radio">
        <label>
          {{ Form::radio('visible', 1, $page->visible == 1 ? true : '') }}
          True
        </label>
      </div>
      <div class="radio">
        <label>
          {{ Form::radio('visible', 0, $page->visible == 0 ? true : '') }}
          False
        </label>
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('content', 'Comments:', ['class' => 'control-label']) }}
      {{ Form::textarea('content', $page->content, ['size' => '30x5',
                                          'class' => 'form-control',
                                          'placeholder' => 'Write anything you like!']) }}
    </div>
    <div class="form-group submit_group">
      {{ link_to('/manage_content', $title = 'Return', ['class' => 'btn btn-default']) }}
      {{ Form::button('<span class="glyphicon glyphicon-pencil"></span> Edit Page',
        ['type' => 'submit', 'class' => 'btn btn-info']) }}
      {{ Form::close() }}
    </div>
    {{ Form::open(['route' => ['page.destroy', $page->id], 'method' => 'delete']) }}
      <button type="submit" class="btn btn-danger">
        <span class="glyphicon glyphicon-remove"></span> Delete Page</button>
    {{ Form::close() }}
  </div>
@stop
