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
                        <h1 class="text-2xl font-bold mb-4">Lista de Posts</h1>
                        <table id="todoTable" class="min-w-full border-collapse border border-gray-200">
                            <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2">id</th>
                                <th class="border border-gray-300 px-4 py-2">title</th>
                                <th class="border border-gray-300 px-4 py-2">description</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">completed</th>
                                <th class="border border-gray-300 px-4 py-2">Fecha de Creación</th>
                                <th class="border border-gray-300 px-4 py-2">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Los datos se llenarán por DataTables -->
                            </tbody>
                        </table>
                    </div>
                    <div class="container mx-auto p-4">
                        <a href="{{route('todo.create')}}" class="inline-block px-6 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                            create new
                        </a>

                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

