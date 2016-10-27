<!DOCTYPE html>
<html lang="en">
  <head>
    @include('includes.head')
  </head>
  <body>
    <div id="app">
      <header class="col-xs-12">
        @include('includes.nav')
      </header>
      <aside class="col-md-4">
        @include('includes.aside')
      </aside>
      <section class="col-md-8">
        <article class="">
          @yield('content')
        </article>
      </section>
    </div>
    <footer class="col-xs-12">
      @include('includes.footer')
    </footer>
  </body>
</html>
