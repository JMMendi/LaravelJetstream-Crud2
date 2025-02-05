<x-self.base>
    <div class="flex w-full items-center mb-2 justify-between">
        <div>
            <x-input placeholder="Buscar..." wire:model.live="buscar" /><i class="mr-2 fas fa-search"></i>
        </div>
        <div>
            @livewire('crear-post')
        </div>
    </div>
    @if($posts->count())
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead @class([ "text-xs text-gray-700 uppercase" , "bg-green-200 dark:bg-green-700"=>!Auth::user()->is_admin,
                "bg-red-200 dark:bg-red-700"=>Auth::user()->is_admin,
                ])>
                <tr>
                    <th scope="col" class="px-16 py-3">
                        <span class="sr-only">Image</span>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('titulo')">
                        Título<i class="ml-1 fas fa-sort"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('nombre')">
                        Categoria<i class="ml-1 fas fa-sort"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('estado')">
                        Estado<i class="ml-1 fas fa-sort "></i>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="p-4">
                        <img src="{{Storage::url($item->imagen)}}" class="w-16 md:w-32 max-w-full max-h-full" alt="Imagen Post">
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        {{$item->titulo}}
                    </td>
                    <td class="px-6 py-4">
                        {{$item->nombre}}
                    </td>
                    <td class="px-6 py-4">
                        <button @class([ 'p-2 rounded-xl text-white font-bold' , 'bg-red-500 hover:bg-red-800'=> $item->estado === "Borrador",
                            'bg-green-500 hover:bg-green-800' => $item->estado === "Publicado",
                            ]) wire:click="cambiarEstado({{$item->id}})"> {{$item->estado}}

                        </button>
                    </td>
                    <td class="px-6 py-4">
                        <button wire:click="confirmarDelete({{$item->id}})">
                            <i class="fas fa-trash text-gray-500 hover:text-gray-800 hover:text-xl mr-2"></i>
                        </button>
                        <button wire:click="edit({{$item->id}})">
                            <i class="fas fa-edit text-green-500 hover:text-green-800 hover:text-xl mr-2"></i>
                        </button>
                        <button wire:click="abrirDetalle({{$item->id}})">
                            <i class="fas fa-info text-blue-500 hover:text-blue-800 hover:text-xl mr-2"></i>
                        </button>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div class="mt-2">
        {{$posts->links()}}
    </div>
    @else
    <p @class([ "w-full p-4 rounded-xl shadow-xl font-bold" , "bg-green-200 dark:bg-green-700"=>!Auth::user()->is_admin,
        "bg-red-200 dark:bg-red-700"=>Auth::user()->is_admin,
        ])>
        No se encontró ningún post o aún no ha escrito ninguno.
    </p>
    @endif

    <!-- Modal de Update -->
    <!--  El isset es necesario para lo de la imagen, si no, te da error -->
    @isset($uform->post)
    <x-dialog-modal wire:model="abrirModalUpdate" maxWidth='4xl'>
        <x-slot name="title">
            Editar Post
        </x-slot>
        <x-slot name="content">
            <div class="mb-5">
                <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título del Post</label>
                <input type="text" wire:model="uform.titulo" name="titulo" id="titulo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <x-input-error for="uform.titulo" />

            </div>
            <div class="mb-5">
                <label for="contenido" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contenido del Post</label>
                <textarea name="contenido" wire:model="uform.contenido" id="contenido" cols=100 rows=5></textarea>
                <x-input-error for="uform.contenido" />

            </div>
            <div class="mb-5">
                <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado del Post</label>
                <input type="radio" id="estado" name="estado" wire:model="uform.estado" value="Publicado" class="mr-2" />Publicado
                <input type="radio" id="estado" name="estado" wire:model="uform.estado" value="Borrador" class="mr-2" />Borrador
                <x-input-error for="uform.estado" />

            </div>
            <div class="mb-5">
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoría del Post</label>
                <select wire:model="uform.category_id" name="category_id" id="category_id">
                    <option selected value="">ESCOJA UNA CATEGORÍA</option>
                    @foreach ($categorias as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
                <x-input-error for="uform.category_id" />
            </div>
            <div class="mb-5">
                <label for="imagen_u" class="block text-lg font-medium text-gray-700 mb-2"></label>
                <div class="w-full h-80 bg-gray-200 relative">
                    <input type="file" id="imagen_u" hidden accept="image/*" wire:model="uform.imagen" />
                    <label for="imagen_u" class="text-white font-bold absolute bottom-2 end-2 p-2 rounded-lg bg-black hover:bg-gray-600">
                        <i class="fas fa-upload mr-2"></i>SUBIR
                    </label>
                    @isset($uform->imagen)
                    <img src="{{$uform->imagen->temporaryUrl()}}" class="size-full bg-repeat bg-center bg-cover" alt="" />
                    @else
                    <img src="{{Storage::url($uform->post->imagen)}}" class="size-full bg-repeat bg-center bg-cover" alt="" />
                    @endisset
                </div>
            </div>
            <x-input-error for="uform.imagen" />

        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse justify-center">
                <button type="submit" wire:loading.attr="hidden" wire:click="update" class="mr-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Editar</button>
                <button type="button" wire:click="cerrarModal" class="mr-2 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Volver</button>
            </div>
        </x-slot>
    </x-dialog-modal>
    @endisset

    <!-- Modal para la vista Detalle  -->
    @isset($postDetalle)
    <x-dialog-modal wire:model="abrirModalDetalle" maxWidth="3xl">
        <x-slot name="title">
            <div class="text-center">
                <h1>{{$postDetalle->titulo}}</h1>

            </div>
        </x-slot>
        <x-slot name="content">
            <div class="flex flex-row-reverse">
                <div class="flex flex-column justify-between">
                    <p>
                        {{$postDetalle->contenido}}
                    </p>
                    <div class="px-6 py-4">
                        <button @class([ 'p-2 rounded-xl text-white font-bold' , 'bg-red-500 hover:bg-red-800'=> $postDetalle->estado === "Borrador",
                            'bg-green-500 hover:bg-green-800' => $postDetalle->estado === "Publicado",
                            ])"> {{$postDetalle->estado}}
                        </button>
                    </div>
                </div>

                <div>
                    <img src="{{Storage::url($postDetalle->imagen)}}" width=480 height=360 alt="Imagen del post {{$postDetalle->titulo}}">
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button type="button" wire:click="cerrarDetalle" class="mr-2 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Volver</button>
        </x-slot>
    </x-dialog-modal>
    @endisset
</x-self.base>