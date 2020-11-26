<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Laravel</title>
</head>

<body>
    <div class="container">
        <h1>LIST ROUTES</h1>

        <div class="main">
            @foreach ($routes as $route)
            @if (!preg_match("/_ignition/i", $route->uri))
            <div class="alert alert-success shadow mb-4 border-0" role="alert">
                <span>
                    Link :
                </span>
                <a href="{{ url($route->uri) }}" class="underline text-gray-900 dark:text-white">
                    --> {{ $route->uri }}
                </a>
                <span>
                    Method : {{ $route->methods[0] }}
                </span>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</body>

</html>
