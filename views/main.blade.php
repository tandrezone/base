<?php
  $client = new client();
  $styles = $client->getStyles();
  $scripts = $client->getScripts();
?>
<html>
    <head>
         {!!$styles!!}
         @yield('extfiles')
        <title>Lite Framework - @yield('title')</title>
    </head>
    <body>
       @yield('content')
       {!!$scripts!!}
    </body>
</html>
