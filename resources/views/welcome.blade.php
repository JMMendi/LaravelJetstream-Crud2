<x-app-layout>
    <x-self.base>
        <h3 class="mb-2 text-center w-full text-2xl font-bold">
            Listado de Posts
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
            @foreach ($posts as $item)
            <article @class([
                'p-1 rounded-2xl shadow-xl h-96 bg-cover bg-no-repeat',
                'md:col-span-2' => $loop->first,

                ]) style="background-image:url({{Storage::url($item->imagen)}})">
                <div class="flex flex-col justify-between h-full text-center items-center">
                    <div class="text-xl font-bold text-white p-1 rounded-xl bg-gray-400">
                        {{$item->titulo}}
                    </div>
                    <div class="bg-gray-400 p-1 rounded-2xl italic text-white">
                        {{$item->contenido}}
                    </div>
                    <div class="font-bold rounded-2xl p-2 text-black" style="background-color:{{$item->category->color}}">
                        {{$item->category->nombre}}
                    </div>
                    <div class="p-2 font-bold rounded-xl text-center text-blue-200 italic bg-gray-400">
                        {{$item->user->email}}
                    </div>
                    <div class="p-2 bg-gray-400 rounded-2xl">
                        {{$item->updated_at->format('d/m/Y')}}
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </x-self.base>
    @session('mensaje')
        <script>
            Swal.fire("{{session('mensaje')}}");
        </script>
    @endsession
</x-app-layout>