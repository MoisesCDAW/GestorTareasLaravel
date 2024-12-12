<div>
    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-2xl font-semibold">
                        Bienvenido {{ $user }}
                    </div>
                    <div>
                        Tienes {{$tasks->count()}} tarea(s) creadas
                    </div>
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
            </div>
        </div>
    </div> --}}

    <div class="text-gray-900 bg-gray-200">
        <div class="p-4 flex">
            <h1 class="text-3xl">
                Users
            </h1>
        </div>
        <button type="button" class="ms-[32%] h-[40px] text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline" wire:click="openCreatemodal">Crear Tarea</button>
        <div class="px-3 py-4 flex justify-center">
            <table class="w-[40%] text-md bg-white shadow-md rounded mb-4">
                <tbody>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">Tarea</th>
                        <th class="text-left p-3 px-5">Descripcion</th>
                        <th>Acciones</th>
                    </tr>

                    @foreach ($tasks as $item)              
                        <tr class="border-b hover:bg-orange-100 bg-gray-100">
                            <td class="p-3 px-5">{{$item->title}}</td>
                            <td class="p-3 px-5">{{$item->descripcion}}</td>
                            <td class="p-3 px-5 flex justify-end">
                                <button type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Editar</button>
                                <button type="button" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Borrar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Componente MODAL --}}
        @if ($modal)
            <div class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
                <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
                    <div class="w-full">
                        <div class="m-8 my-20 max-w-[400px] mx-auto">
                            <div class="mb-8">
                                <h1 class="mb-4 text-3xl font-extrabold">Crear Tarea</h1>
                                <form>
                                    <input class="w-full mb-4 rounded" type="text" wire:model="title" name="title" id="title" autocomplete="title" placeholder="Tarea">
                                    <textarea class="w-full rounded" type="text" wire:model="descripcion" name="descripcion" id="descripcion" autocomplete="descripcion" placeholder="Descripcion"></textarea>
                                </form>
                            </div>
                            <div class="space-y-4">
                                <button class="p-3 bg-black rounded-full text-white w-full font-semibold" wire:click="crearTareaModal">Crear</button>
                                <button class="p-3 bg-white border rounded-full w-full font-semibold" wire:click="closeModal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>