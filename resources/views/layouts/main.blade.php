<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aflaam</title>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css">
    <livewire:styles>
{{--        Alpine JS est un framework javascript très light développé par Caleb Porzio l'auteur de livewire --}}
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>
<body class="font-sans bg-gray-900 text-white">
    <nav class="border-b border-gray-800">
        <div class="container flex flex-col md:flex-row items-center mx-auto justify-between px-4 py-6">
            <ul class="flex flex-col md:flex-row items-center">
                <li>
                    <a href="{{ route(('movies.index')) }}" class="flex items-center">
                        <svg class="w-16 fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M18 4l2 3h-3l-2-3h-2l2 3h-3l-2-3H8l2 3H7L5 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4h-4zm-6.75 11.25L10 18l-1.25-2.75L6 14l2.75-1.25L10 10l1.25 2.75L14 14l-2.75 1.25zm5.69-3.31L16 14l-.94-2.06L13 11l2.06-.94L16 8l.94 2.06L19 11l-2.06.94z"/>
                            <path fill="none" d="M0 0h24v24H0z"/>
                        </svg>
                        <span class="px-2 text-4xl" style="font-family: 'Righteous', cursive;">aflaam</span>
                    </a>
                </li>
                <li class="md:ml-16 mt-3 md:mt-0">
                    <a href="" class="hover:text-gray-300">Movies</a>
                </li>
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a href="{{ route('tv.index') }}" class="hover:text-gray-300">TV Shows</a>
                </li>
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a href="{{ route('persons.index') }}" class="hover:text-gray-300">People</a>
                </li>
            </ul>
            <div class="flex flex-col md:flex-row items-center">
                <livewire:search-dropdown>
                <div class="mt-3 md:ml-4 md:mt-0">
                    <a href="">
                        <img src="/images/avatar.png"
                             alt="avatar"
                             class="rounded-full w-8 h-8"
                        >
                    </a>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')
    <livewire:scripts>
    @yield('scripts')
</body>
</html>
