<div>
    <x-button class="font-bold" wire:click="$set('abrirModalCrear',true)">
        <i class="fas fa-add mr-2"></i>NUEVO
    </x-button>
    <x-dialog-modal wire:model="abrirModalCrear" maxWidth='4xl'>
        <x-slot name="title">
            Crear Post
        </x-slot>
        <x-slot name="content">
            <div class="mb-5">
                <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título del Post</label>
                <input type="text" wire:model="cform.titulo" name="titulo" id="titulo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                <x-input-error for="cform.titulo"/>

            </div>
            <div class="mb-5">
                <label for="contenido" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contenido del Post</label>
                <textarea name="contenido" wire:model="cform.contenido" id="contenido" cols=100 rows=5></textarea>
                <x-input-error for="cform.contenido"/>

            </div>
            <div class="mb-5">
                <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado del Post</label>
                <input type="radio" id="estado" name="estado" wire:model="cform.estado" value="Publicado" class="mr-2"/>Publicado
                <input type="radio" id="estado" name="estado" wire:model="cform.estado" value="Borrador" class="mr-2"/>Borrador
                <x-input-error for="cform.estado"/>

            </div>
            <div class="mb-5">
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoría del Post</label>
                <select wire:model="cform.category_id" name="category_id" id="category_id">
                    <option selected value="">ESCOJA UNA CATEGORÍA</option>
                    @foreach ($categorias as $item)
                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
                <x-input-error for="cform.category_id"/>
            </div>
            <div class="mb-5">
                <label for="imagen_c" class="block text-lg font-medium text-gray-700 mb-2"></label>
                <div class="w-full h-80 bg-gray-200 relative">
                    <input type="file" id="imagen_c" hidden accept="image/*" wire:model="cform.imagen"/>
                    <label for="imagen_c" class="text-white font-bold absolute bottom-2 end-2 p-2 rounded-lg bg-black hover:bg-gray-600">
                        <i class="fas fa-upload mr-2"></i>SUBIR
                    </label>
                    @isset($cform->imagen)
                        <img src="{{$cform->imagen->temporaryUrl()}}" class="size-full bg-repeat bg-center bg-cover" alt=""/>                        
                    @endisset
                </div>
            </div>
            <x-input-error for="cform.imagen"/>

        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse justify-center">
                <button type="submit" wire:loading.attr="hidden" wire:click="store" class="mr-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Publicar</button>
                <button type="button" wire:click="cerrarModal" class="mr-2 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Volver</button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>