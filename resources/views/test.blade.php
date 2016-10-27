<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Test Page</title>
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" media="screen" title="no title">
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/all.js') }}"></script>
  </head>
  <body>
    <script>
      $(document).ready(function(){
          $("h1").click(function(){
              $("p").hide();
          });
      });
    </script>
    <div class="jumbotron">
      <h1 class="anotherOne">Hello</h1>
      <p>
        World!2
      </p>
    </div>
    <input type="button" class="btn btn-danger" onclick="slay_dragon()" value="Slay!"/>
    <br>

    <button type="button" name="button">Press Me</button>
    <div class="thisOne">
      <p>
        hi
      </p>
    </div>


  </body>
</html>
