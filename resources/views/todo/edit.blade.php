<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="container mx-auto p-6">
                        <h1 class="text-2xl font-bold mb-4">Crear Nueva Tarea</h1>
                        <form action="{{ route('todo.update', $todoList->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="title" class="block text-gray-700">Título</label>
                                <input type="text" name="title" id="title"
                                       value="{{ old('title', $todoList->title) }}"
                                       class="mt-1 block w-full p-2 border border-gray-300 rounded"
                                       required>
                                @error('title')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block text-gray-700">Descripción</label>
                                <textarea name="description" id="description" rows="4"
                                          class="mt-1 block w-full p-2 border border-gray-300 rounded"
                                          required>{{ old('description', $todoList->description) }}</textarea>
                                @error('description')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 flex items-center">
                                <input type="checkbox" name="completed" id="completed"
                                       value="1" {{ $todoList->completed ? 'checked' : '' }}
                                       class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="completed" class="text-gray-700">Completado</label>
                            </div>

                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Actualizar Tarea
                            </button>
                            <a href="{{ route('todo.index') }}" class="ml-4 text-blue-500 hover:underline">Volver a la lista</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
