<?php
  use App\Subject;
  $subjects = Subject::orderBy('position', 'asc')->get();
?>

@extends('layouts.app')
@section('content')
  <h2>Manage content</h2>
  @if(Session::has('message'))
    <div class="alert alert-success">
      <span class="glyphicon glyphicon-ok"></span><em> {{ session('message') }}</em>
    </div>
  @endif
  {{ Form::open(['route' => ['subject.create'], 'method' => 'get']) }}
    <button type="submit" class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span> New Subject</button>
  {{ Form::close() }}
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Subject Name:</th>
        <th>Actions:</th>
        <th>Pages:</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($subjects as $subject)
      <tr>
        <td>{{ $subject->menu_name }} </td>
        <td>
          <a href="/subject/{{$subject->id}}/edit" >
            <button type="button" name="button"class="btn btn-info">
              <span class="glyphicon glyphicon-pencil"></span> Edit</button>
          </a>
          {{ Form::open(['route' => ['subject.destroy', $subject->id], 'method' => 'delete']) }}
            <button type="submit" class="btn btn-danger">
              <span class="glyphicon glyphicon-remove"></span> Delete</button>
          {{ Form::close() }}
        </td>
        <td>
          {{ Form::open(['url' => ['page/create', $subject->id], 'method' => 'GET']) }}
            <button type="submit" class="btn btn-success">
              <span class="glyphicon glyphicon-plus"></span> Create Page</button>
          {{ Form::close() }}
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>



@stop
