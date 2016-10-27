<?php
  use App\Subject;
  $subject_count = Subject::max('position');
?>

@extends('layouts.app')
@section('content')
  <div class="container-fluid">
    <h2>Edit Subject: {{ $subject->menu_name }}</h2>
    @foreach ($errors->all() as $error)
      <li class="error error_fonts">{{ $error }}</li>
    @endforeach
    {{-- Form::open(['url' => 'subject/', $subject->id]) --}}
    {{-- Form::model($subject, ['method' => 'PATCH','route' => ['subject.update', $subject->id]]) --}}
    {{ Form::open(['route' => ['subject.update', $subject->id], 'method' => 'PATCH']) }}
    <div class="form-group">
      <div class="menu_name_textfield">
        {{ Form::label('menu_name', 'Menu Name:', ['class' => 'control-label']) }}
        {{ Form::text('menu_name', $subject->menu_name, ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="form-group">
      <div class="select_field">
        {{ Form::label('position', 'Position:', ['class' => 'control-label']) }}
        {{ Form::selectRange('position', 1, $subject_count + 1, $subject->position, ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('visible', 'Visible:', ['class' => 'control-label']) }}
      <div class="radio">
        <label>
          {{ Form::radio('visible', 1, $subject->visible == 1 ? true : '') }}
          True
        </label>
      </div>
      <div class="radio">
        <label>
          {{ Form::radio('visible', 0, $subject->visible == 0 ? true : '') }}
          False
        </label>
      </div>
    </div>
    <div class="form-group submit_group">
      {{ link_to('/manage_content', $title = 'Cancel', ['class' => 'btn btn-info']) }}
      {{ Form::submit('Edit Subject', ['class' => 'btn btn-success']) }}
    </div>
    {{ Form::close() }}
  </div>
@stop
