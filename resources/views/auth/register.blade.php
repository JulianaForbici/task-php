<x-layout>
    <x-slot:title>
        Criar conta
    </x-slot:title>

    <div class="hero min-h-[calc(100vh-14rem)]">
        <div class="hero-content w-full max-w-md">
            <div class="card w-full bg-base-100 shadow-xl border border-base-200">
                <div class="card-body">
                    <div class="text-center mb-6">
                        <div class="badge badge-primary badge-outline mb-3">TaskManager ☕</div>
                        <h1 class="text-3xl font-bold">Criar conta</h1>
                        <p class="text-sm text-base-content/60 mt-2">
                            Cadastre-se para começar a organizar e gerenciar suas tarefas.
                        </p>
                    </div>

                    <form method="POST" action="/register" class="space-y-5">
                        @csrf

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Nome</span>
                            </label>
                            <input
                                type="text"
                                name="name"
                                placeholder="Seu nome"
                                value="{{ old('name') }}"
                                class="input input-bordered w-full @error('name') input-error @enderror"
                                required
                            >
                            @error('name')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">E-mail</span>
                            </label>
                            <input
                                type="email"
                                name="email"
                                placeholder="email@exemplo.com"
                                value="{{ old('email') }}"
                                class="input input-bordered w-full @error('email') input-error @enderror"
                                required
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
                            <label class="label">
                                <span class="label-text font-medium">Confirmar senha</span>
                            </label>
                            <input
                                type="password"
                                name="password_confirmation"
                                placeholder="••••••••"
                                class="input input-bordered w-full"
                                required
                            >
                        </div>

                        <div class="form-control pt-2">
                            <button type="submit" class="btn btn-primary w-full">
                                Criar conta
                            </button>
                        </div>
                    </form>

                    <div class="divider">OU</div>

                    <p class="text-center text-sm text-base-content/70">
                        Já tem uma conta?
                        <a href="/login" class="link link-primary font-medium">Entrar</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>