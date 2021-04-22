<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name'), 'V-I-F-L'}}</title>
    <meta name="user" content="{{ Auth::user() }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles-->
    <link rel="stylesheet" href="{{ mix('css/app.css')}}">
    <!-- Scripts-->
    @routes
    <script src="{{ mix('js/app.js')}}" defer></script>
</head>
<body>
    @inertia
</body>
</html>