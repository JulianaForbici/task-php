<!DOCTYPE html>
<html lang="pt-BR" data-theme="lofi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' - TaskManager' : 'TaskManager' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-base-200 font-sans text-base-content">
    <div class="min-h-screen flex flex-col">
        <nav class="navbar bg-base-100/90 backdrop-blur border-b border-base-300 sticky top-0 z-50 px-4 lg:px-8">
            <div class="navbar-start">
                <a href="/" class="btn btn-ghost text-xl font-extrabold tracking-tight">
                    <span class="text-primary">☕</span>
                    <span>TaskManager</span>
                </a>
            </div>

            <div class="navbar-center hidden md:flex">
                @auth
                    <ul class="menu menu-horizontal px-1 gap-2">
                    </ul>
                @endauth
            </div>

            <div class="navbar-end gap-2">
                @auth
                    <div class="hidden sm:flex items-center gap-3 mr-2">
                        <div class="avatar">
                            <div class="size-10 rounded-full">
                                <img
                                    src="https://avatars.laravel.cloud/{{ urlencode(auth()->user()->email) }}"
                                    alt="{{ auth()->user()->name }}'s avatar"
                                    class="rounded-full"
                                />
                            </div>
                        </div>

                        <span class="text-sm font-semibold">{{ auth()->user()->name }}</span>
                    </div>

                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit" class="btn btn-ghost btn-sm">
                            Sair
                        </button>
                    </form>
                @else
                    <a href="/login" class="btn btn-ghost btn-sm">Entrar</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Criar conta</a>
                @endauth
            </div>
        </nav>

        @if (session('success'))
            <div class="toast toast-top toast-center z-[60] mt-16">
                <div class="alert alert-success shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="max-w-4xl mx-auto w-full px-4 pt-6">
                <div class="alert alert-error shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />
                    </svg>
                    <span>Existem campos inválidos. Revise o formulário e tente novamente.</span>
                </div>
            </div>
        @endif

        <main class="flex-1 w-full">
            <div class="container mx-auto px-4 py-8">
                {{ $slot }}
            </div>
        </main>

        <footer class="footer footer-center p-6 bg-base-300 text-base-content border-t border-base-300">
            <div class="space-y-1">
                <p class="font-semibold">☕ TaskManager</p>
            </div>
        </footer>
    </div>
</body>
</html>