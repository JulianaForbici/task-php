@props(['task'])

<div class="card bg-base-100 shadow">
    <div class="card-body">
        <div class="flex space-x-3">
            @if ($task->user)
                <div class="avatar">
                    <div class="size-10 rounded-full">
                        <img
                            src="https://avatars.laravel.cloud/{{ urlencode($task->user->email) }}"
                            alt="{{ $task->user->name }}'s avatar"
                            class="rounded-full"
                        />
                    </div>
                </div>
            @else
                <div class="avatar placeholder">
                    <div class="size-10 rounded-full">
                        <img
                            src="https://avatars.laravel.cloud/f61123d5-0b27-434c-a4ae-c653c7fc9ed6?vibe=stealth"
                            alt="Anonymous User"
                            class="rounded-full"
                        />
                    </div>
                </div>
            @endif

            <div class="min-w-0 flex-1">
                <div class="flex justify-between w-full">
                    <div class="flex items-center gap-1 flex-wrap">
                        <span class="text-sm font-semibold">
                            {{ $task->user ? $task->user->name : 'Usuário' }}
                        </span>

                        <span class="text-base-content/60">·</span>

                        <span class="text-sm text-base-content/60">
                            {{ $task->created_at->diffForHumans() }}
                        </span>

                        @if ($task->updated_at->gt($task->created_at->addSeconds(5)))
                            <span class="text-base-content/60">·</span>
                            <span class="text-sm text-base-content/60 italic">editada</span>
                        @endif
                    </div>

                    @can('update', $task)
                        <div class="flex gap-1">
                            <a href="/tasks/{{ $task->id }}/edit" class="btn btn-ghost btn-xs">
                                Editar
                            </a>

                            <form method="POST" action="/tasks/{{ $task->id }}">
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')"
                                    class="btn btn-ghost btn-xs text-error"
                                >
                                    Excluir
                                </button>
                            </form>
                        </div>
                    @endcan
                </div>

                <div class="mt-1 flex items-center gap-2 flex-wrap">
                    <p class="font-medium">{{ $task->title }}</p>

                    @if ($task->status === 'todo')
                        <span class="badge badge-warning badge-outline badge-sm">To do</span>
                    @elseif ($task->status === 'doing')
                        <span class="badge badge-info badge-outline badge-sm">Doing</span>
                    @elseif ($task->status === 'done')
                        <span class="badge badge-success badge-outline badge-sm">Done</span>
                    @endif
                </div>

                @if ($task->description)
                    <p class="mt-2 text-sm text-base-content/80">
                        {{ $task->description }}
                    </p>
                @endif

                @if ($task->due_date)
                    <p class="mt-2 text-sm text-base-content/60">
                        Prazo: {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>