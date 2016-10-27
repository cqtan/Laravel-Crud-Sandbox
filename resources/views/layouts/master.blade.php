<!DOCTYPE html>
<html>
  <head>
    @include('includes.head')
  </head>
  <body>

    <header class="col-xs-12">
      @include('includes.header')
    </header>

    <aside class="col-md-4">
      @include('includes.aside')
    </aside>

    <section class="col-md-8">
      <article class="">
        @yield('content')
      </article>
    </section>

    <footer class="col-xs-12">
      @include('includes.footer')
    </footer>

  </body>
</html>
