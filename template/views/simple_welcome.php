<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300"/>
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}"/>

    <style>
        html, body {
            background-color: #fff;
            font-size: 16px;
            height: 100vh;
            margin: 0;
        }
        .center {
            position: relative;
            align-items: center;
            display: flex;
            height: 100vh;
            justify-content: center;
            text-align: center;
        }
        .title {
            color: #636b6f;
            font-size: 6em;
            margin-bottom: 100px;
            font-family: 'Roboto', sans-serif;
        }
    </style>

    {{ ie_support_field() }}

    <title>Started</title>
</head>
<body>
    <div class="center">
        <div class="title">Welcome</div>
    </div>
</body>
</html>