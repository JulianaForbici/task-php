<x-layout>
    <x-slot:title>
        Editar tarefa
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">Editar tarefa</h1>

        <div class="card bg-base-100 shadow mt-8">
            <div class="card-body">
                <form method="POST" action="/tasks/{{ $task->id }}">
                    @csrf
                    @method('PUT')

                    <div class="form-control w-full mb-4">
                        <label class="label">
                            <span class="label-text font-medium">Título</span>
                        </label>
                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $task->title) }}"
                            class="input input-bordered w-full @error('title') input-error @enderror"
                            maxlength="120"
                            required
                        >

                        @error('title')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-control w-full mb-4">
                        <label class="label">
                            <span class="label-text font-medium">Descrição</span>
                        </label>
                        <textarea
                            name="description"
                            class="textarea textarea-bordered w-full resize-none @error('description') textarea-error @enderror"
                            rows="4"
                        >{{ old('description', $task->description) }}</textarea>

                        @error('description')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
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
                                required
                            >
                                <option value="todo" @selected(old('status', $task->status) === 'todo')>To do</option>
                                <option value="doing" @selected(old('status', $task->status) === 'doing')>Doing</option>
                                <option value="done" @selected(old('status', $task->status) === 'done')>Done</option>
                            </select>

                            @error('status')
                                <div class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-medium">Prazo</span>
                            </label>
                            <input
                                type="date"
                                name="due_date"
                                value="{{ old('due_date', $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '') }}"
                                class="input input-bordered w-full @error('due_date') input-error @enderror"
                            >

                            @error('due_date')
                                <div class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-actions justify-between mt-6">
                        <a href="/" class="btn btn-ghost btn-sm">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm">
                            Atualizar tarefa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>