<!DOCTYPE html>

<head>
    <title>Laravel + Vue Chat</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])

</head>

<body class="font-body text-base text-black dark:text-white dark:bg-slate-900">
<div id="app">
    <app
        :is-auth="{{ json_encode(auth()->check()) }}"
        :user="{{ auth()->check() ? auth()->user() : 'null' }}"
        :rooms="{{auth()->user()->rooms}}">
    </app>

</body>

</html>
