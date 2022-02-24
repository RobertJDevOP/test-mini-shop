<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Mini shop</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.3.95/css/materialdesignicons.min.css">
    </head>
    <body>
        <div id="app">
          <Shop></Shop>
          <Userdataconfirmation></Userdataconfirmation>
        </div>

        <script src="{{ asset(mix('js/manifest.js')) }}"></script>
        <script src="{{ asset(mix('js/vendor.js')) }}"></script>
        <script src="{{ asset(mix('js/app.js')) }}"></script>
    </body>
</html>

