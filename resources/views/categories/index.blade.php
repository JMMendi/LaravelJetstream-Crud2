<x-app-layout>
    <x-self.base>
        <div class="relative overflow-x-auto">
            <div class="flex flex-row-reverse">
                <a href="{{route('categories.create')}}" class="p-2 rounded-xl text-white bg-blue-500 hover:bg-blue-700">
                    <i class="fas fa-add ml-2"></i> NUEVO
                </a>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Categorias
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Color
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$item->nombre}}
                        </th>
                        <td class="px-6 py-4">
                            <div class="p-2 rounded-xl w-32 font-bold text-white" style="background-color: {{$item->color}};">
                                {{$item->color}}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{route('categories.destroy', $item)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{route('categories.edit', $item)}}">
                                    <i class="fas fa-edit text-green-500 hover:text-xl hover:text-green-700"></i>
                                </a>
                                <button type="submit">
                                    <i class="fas fa-trash text-gray-500 hover:text-xl hover:text-gray-700"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-self.base>
    @session('mensaje')
    <script>
        Swal.fire({
            icon: "success",
            title: "{{session('mensaje')}}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
    @endsession
</x-app-layout>