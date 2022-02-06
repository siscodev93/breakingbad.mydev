<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Breaking Bad Challenge</title>
    @livewireStyles

    <link rel="stylesheet" href="{{mix('/css/app.css')}}" />

</head>
<body class="w-full h-full bg-slate-200">
    <main class="border-box w-full shadow-sm">
        @yield('content')
    </main>
    @livewireScripts

</body>
</html>
