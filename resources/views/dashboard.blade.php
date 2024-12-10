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
                    <div class="text-2xl font-semibold">
                        Bienvenido {{ $user }}
                    </div>
                    <div>
                        Tienes {{$tasks->count()}} tarea(s) creadas
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($tasks as $item)
                        <h1 class="text-green-900 text-xl">
                            {{$item->title}}
                        </h1>
                        <p class="">
                            {{$item->descripcion}}
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
