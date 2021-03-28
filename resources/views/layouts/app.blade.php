<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Prohlížeč databáze</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
    @include("layouts.navbar")

    @if(count($errors) > 0)
        <div class="alert alert-danger"><ul>
            @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
            @endforeach
        </ul></div>
    @endif
    @if(session("ok"))
        <div class="alert alert-success">
            {{session("ok")}}
        </div>
    @endif
    @if(session("error"))
        <div class="alert alert-danger">
            {{session("error")}}
        </div>
    @endif
    <div class="container">
        @yield("content")
    </div>
</body>
</html>
