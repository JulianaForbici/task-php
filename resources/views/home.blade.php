<x-layout>
    <x-slot:title>
        Home
    </x-slot:title>

    @php
        $todoCount = $tasks->where('status', 'todo')->count();
        $doingCount = $tasks->where('status', 'doing')->count();
        $doneCount = $tasks->where('status', 'done')->count();
    @endphp

    <div class="max-w-4xl mx-auto px-4 py-8 space-y-8">
        <div class="hero bg-base-200 rounded-3xl shadow-sm">
            <div class="hero-content text-center py-10">
                <div class="max-w-2xl">
                    <h1 class="text-4xl font-bold">Organize suas tarefas aqui</h1>
                    <p class="py-4 text-base-content/70">
                    Crie, acompanhe e conclua suas tasks.
                    </p>

                    <div class="stats stats-vertical lg:stats-horizontal shadow bg-base-100 mt-4">
                        <div class="stat">
                            <div class="stat-title">To do</div>
                            <div class="stat-value text-warning">{{ $todoCount }}</div>
                            <div class="stat-desc">Tarefas pendentes</div>
                        </div>

                        <div class="stat">
                            <div class="stat-title">Doing</div>
                            <div class="stat-value text-info">{{ $doingCount }}</div>
                            <div class="stat-desc">Em andamento</div>
                        </div>

                        <div class="stat">
                            <div class="stat-title">Done</div>
                            <div class="stat-value text-success">{{ $doneCount }}</div>
                            <div class="stat-desc">Concluídas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl border border-base-200">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="card-title text-2xl">Nova tarefa</h2>
                        <p class="text-sm text-base-content/60">
                            Adicione uma nova task para acompanhar seu progresso.
                        </p>
                    </div>
                </div>

                <form method="POST" action="/tasks" class="space-y-4">
                    @csrf

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-medium">Título</span>
                        </label>
                        <input
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Ex: Finalizar bootcamp do Laravel"
                            class="input input-bordered w-full @error('title') input-error @enderror"
                            maxlength="120"
                            required
                        >
                        @error('title')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-medium">Descrição</span>
                        </label>
                        <textarea
                            name="description"
                            placeholder="Descreva a tarefa..."
                            class="textarea textarea-bordered w-full resize-none @error('description') textarea-error @enderror"
                            rows="4"
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-medium">Status</span>
                            </label>
                            <select
                                name="status"
                                class="select select-bordered w-full @error('status') select-error @enderror"
                            >
                                <option value="todo" @selected(old('status') === 'todo')>To do</option>
                                <option value="doing" @selected(old('status') === 'doing')>Doing</option>
                                <option value="done" @selected(old('status') === 'done')>Done</option>
                            </select>
                            @error('status')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-medium">Prazo</span>
                            </label>
                            <input
                                type="date"
                                name="due_date"
                                value="{{ old('due_date') }}"
                                class="input input-bordered w-full @error('due_date') input-error @enderror"
                            >
                            @error('due_date')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="btn btn-primary">
                            Criar tarefa
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-2xl font-bold">Minhas tarefas</h2>
                    <p class="text-sm text-base-content/60">
                        Gerencie suas atividades e acompanhe o andamento.
                    </p>
                </div>
            </div>

            <div class="space-y-4">
                @forelse ($tasks as $task)
                    <div class="card bg-base-100 shadow border border-base-200">
                        <div class="card-body">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <h3 class="card-title text-lg">{{ $task->title }}</h3>

                                        @if ($task->status === 'todo')
                                            <div class="badge badge-warning badge-outline">To do</div>
                                        @elseif ($task->status === 'doing')
                                            <div class="badge badge-info badge-outline">Doing</div>
                                        @else
                                            <div class="badge badge-success badge-outline">Done</div>
                                        @endif
                                    </div>

                                    @if ($task->description)
                                        <p class="mt-2 text-base-content/70">
                                            {{ $task->description }}
                                        </p>
                                    @endif

                                    <div class="mt-4 flex flex-wrap gap-2 text-sm text-base-content/60">
                                        @if ($task->due_date)
                                            <div class="badge badge-ghost">
                                                Prazo: {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}
                                            </div>
                                        @endif

                                        <div class="badge badge-ghost">
                                            Criada em {{ $task->created_at->format('d/m/Y H:i') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-outline btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-error btn-outline btn-sm"
                                            onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')"
                                        >
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="hero bg-base-100 rounded-2xl shadow border border-dashed border-base-300 py-12">
                        <div class="hero-content text-center">
                            <div>
                                <svg class="mx-auto h-12 w-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5h6m-7 4h8m-9 4h10m-11 4h12"></path>
                                </svg>
                                <h3 class="mt-4 text-xl font-semibold">Nenhuma tarefa cadastrada</h3>
                                <p class="mt-2 text-base-content/60">
                                    Comece criando sua primeira task no formulário acima.
                                </p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>