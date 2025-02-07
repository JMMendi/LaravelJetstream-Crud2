<x-app-layout>
    <x-self.base>
        <h3 class="text-2xl font-bold text-center mb-3">Formulario de Contacto</h3>
        <div class="bg-gray-500 p-4 border-xl rounded-2xl shadow-xl mx-auto w-1/2">
            <form action="{{route('contacto.procesar')}}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                    <x-input-error for="nombre"/>
                </div>

                @guest
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                        <x-input-error for="email"/>
                    </div>      
                @endguest

                <div class="mb-5">
                    <label for="mensaje" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mensaje</label>
                    <textarea name="mensaje"  id="mensaje" cols=67 rows=5></textarea>
                    <x-input-error for="mensaje"/>
                </div>

                <div class="flex flex-row-reverse justify-between">
                    <button type="submit" class="p-2 bg-green-500 shadow-xl rounded-xl hover:bg-green-700">
                        Enviar
                    </button>
                    <button class="p-2 bg-red-500 shadow-xl rounded-xl hover:bg-red-700">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </x-self.base>
</x-app-layout>