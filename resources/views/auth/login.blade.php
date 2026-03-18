<x-layout>
    <x-slot:title>
        Entrar
    </x-slot:title>

    <div class="hero min-h-[calc(100vh-14rem)]">
        <div class="hero-content w-full max-w-md">
            <div class="card w-full bg-base-100 shadow-xl border border-base-200">
                <div class="card-body">
                    <div class="text-center mb-6">
                        <div class="badge badge-primary badge-outline mb-3">TaskManager ☕</div>
                        <p class="text-sm text-base-content/60 mt-2">
                            Entre para gerenciar suas tarefas com mais organização.
                        </p>
                    </div>

                    <form method="POST" action="/login" class="space-y-5">
                        @csrf

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">E-mail</span>
                            </label>
                            <input
                                type="email"
                                name="email"
                                placeholder="seuemail@exemplo.com"
                                value="{{ old('email') }}"
                                class="input input-bordered w-full @error('email') input-error @enderror"
                                required
                                autofocus
                            >
                            @error('email')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Senha</span>
                            </label>
                            <input
                                type="password"
                                name="password"
                                placeholder="••••••••"
                                class="input input-bordered w-full @error('password') input-error @enderror"
                                required
                            >
                            @error('password')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label cursor-pointer justify-start gap-3">
                                <input type="checkbox" name="remember" class="checkbox checkbox-sm">
                                <span class="label-text">Lembrar de mim</span>
                            </label>
                        </div>

                        <div class="form-control pt-2">
                            <button type="submit" class="btn btn-primary w-full">
                                Entrar
                            </button>
                        </div>
                    </form>

                    <div class="divider">OU</div>

                    <p class="text-center text-sm text-base-content/70">
                        Ainda não tem conta?
                        <a href="/register" class="link link-primary font-medium">Criar conta</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>