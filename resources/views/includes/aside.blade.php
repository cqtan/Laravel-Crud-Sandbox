<?php
  use App\Subject;
  use App\Page;
  $subjects = Subject::orderBy('position', 'asc')->get();
  $pages = Page::orderBy('position', 'asc')->get();
?>

<div class="panel-group" id="accordion">
  <h2 class="accordion_title">Subjects (Pages)</h2>
  @foreach ($subjects as $subject)
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$subject->id}}">
        {{$subject->menu_name}} </a>
      </h4>
    </div>
    <div id="collapse{{$subject->id}}" class="panel-collapse collapse in">
      @foreach ($pages as $page)
        @if ($subject->id === $page->subject_id)
          <div class="panel-body">
          @break
        @endif
      @endforeach
      @foreach ($pages as $page)
        @if ($subject->id === $page->subject_id)
          <a href="/page/{{$page->id}}/edit">{{$page->menu_name}}</a>
          <br>
        @endif
      @endforeach
      @foreach ($pages as $page)
        @if ($subject->id === $page->subject_id)
          </div>
          @break
        @endif
      @endforeach
    </div>
  </div>
  @endforeach
</div>
<br>
<div class="container-fluid">
  <button type="button" class="btn btn-default btn_accordion">Show all</button>
</div>
