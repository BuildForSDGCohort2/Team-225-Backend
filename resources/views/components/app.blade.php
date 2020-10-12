<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Zurri Booking | Documentation</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/bootstrap.css">
        <link rel="stylesheet" href="/assets/css/default.css">
        <link rel="stylesheet" href="/assets/css/styles.css">

        @cloudinaryJS
    </head>
    <body>
        {{ $slot }}
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.3/highlight.min.js" integrity="sha512-tHQeqtcNWlZtEh8As/4MmZ5qpy0wj04svWFK7MIzLmUVIzaHXS8eod9OmHxyBL1UET5Rchvw7Ih4ZDv5JojZww==" crossorigin="anonymous"></script>
    <script>hljs.initHighlightingOnLoad();</script>
</html>
