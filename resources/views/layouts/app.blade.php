<!doctype html>
<html lang="{{str_replace('_','-',app()->getLocale())}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{env('APP_NAME')}} </title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="/css/app.css" rel="stylesheet">
    <script src="/js/app.js" defer></script>

    @yield('css')
</head>
<body>
    @yield('content')
</body>
@yield('js')
</html>
