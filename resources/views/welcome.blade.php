<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />

    <title>Laravel</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="https://php-l4-task-manager.herokuapp.com">
                Laravel
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link " href="https://php-l4-task-manager.herokuapp.com/tasks">
                            tasks                            </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="https://php-l4-task-manager.herokuapp.com/task_statuses">
                            taskStatuses                            </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="https://php-l4-task-manager.herokuapp.com/labels">
                            labels                            </a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="https://php-l4-task-manager.herokuapp.com/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://php-l4-task-manager.herokuapp.com/register">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <div class="container">
            <div class="jumbotron">
                <h1 class="display-4">Task Manager</h1>
                <p class="lead">Simple implementation of typical task manager</p>
                <hr class="my-4">
                <p>Hexlet Project</p>
                <a class="btn btn-primary btn-lg" href="https://hexlet.io" role="button">Learn more</a>
            </div>
        </div>
    </main>
</div>
</body>
</html>
