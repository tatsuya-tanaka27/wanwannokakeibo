<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">


        <script>
            window.Laravel = {
                csrfToken: "{{ csrf_token() }}"
            };
        </script>
    </head>

    <body>
        <div id="app">
            <div class="container">
                <router-link to="/">Home</router-link>
                <router-link to="/login">Login</router-link>
                <router-view></router-view>
            </div>
        </div>
    </body>
    <script src="{{ mix('js/app.js') }}"></script>

</html>
