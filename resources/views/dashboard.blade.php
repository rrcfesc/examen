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
                    <div class="container mx-auto p-4">
                        <h1 class="text-2xl font-bold mb-4">Lista de Tareas</h1>
                            <table id="todoTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr class="bg-gray-100">
                                        <th scope="col" class="px-6 py-3">id</th>
                                        <th scope="col" class="px-6 py-3">title</th>
                                        <th scope="col" class="px-6 py-3">description</th>
                                        <th scope="col" class="px-6 py-3">completed</th>
                                        <th scope="col" class="px-6 py-3">Fecha de Creación</th>
                                        <th scope="col" class="px-6 py-3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!-- Los datos se llenarán por DataTables -->
                                </tbody>
                            </table>
                    </div>
                    <div class="container mx-auto p-4">
                        <a href="{{route('todo.create')}}" class="inline-block px-6 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                            crear nuevo
                        </a>

                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

