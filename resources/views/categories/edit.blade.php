<x-app-layout>
    <x-self.base>
        <form class="max-w-sm mx-auto" action="{{route('categories.update', $category)}}" method="POST">
            @method('PUT')
            @csrf
            <div class="ms-auto p-8 bg-indigo-200 border-1 rounded-xl shadow-xl">
                <div class="mb-5">
                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Categoría</label>
                    <input type="nombre" id="nombre" value="{{@old('nombre', $category->nombre)}}" name="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    <x-input-error for="nombre" />
                </div>
                <div class="mb-5">
                    <label for="color" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Color de la Categoría</label>
                    <input type="color" id="color" name="color" value="{{@old('color', $category->color)}}" />
                    <x-input-error for="color" />

                </div>
                <div class="mt-2 flex justify-between">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
                    <a href="{{route('categories.index')}}" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">Volver</a>
                </div>
            </div>
        </form>
    </x-self.base>
</x-app-layout>