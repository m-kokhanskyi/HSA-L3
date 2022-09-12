<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>


    </head>
    <body class="antialiased">
    @foreach(\App\Models\User::all() as $user)
        <p>{{$user->name}} - {{$user->email}}</p>
        <br>
    @endforeach
    </body>
</html>
