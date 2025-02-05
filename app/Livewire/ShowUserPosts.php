<?php

namespace App\Livewire;

use App\Livewire\Forms\FormUpdatePost;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowUserPosts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public string $campo = "id", $orden = "desc";
    public string $buscar = "";
    
    public FormUpdatePost $uform;
    public bool $abrirModalUpdate = false;

    public bool $abrirModalDetalle = false;
    public ?Post $postDetalle = null;

    #[On('onPostCreado', 'onPostEliminado')]
    public function render()
    {
        // $posts = Post::with('category')
        //     ->where('user_id', Auth::user()->id)
        // ->where(function ($query) {
        //     $query->where('titulo', 'like', "%{$this->buscar}%")
        //         ->orWhere('estado', 'like', "%{$this->buscar}%");
        // })
        // ->orderBy($this->campo, $this->orden)
        // ->paginate(5);

        $posts = DB::table('posts')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->select('posts.*', 'nombre', 'color')
            ->where('user_id', Auth::user()->id)
            ->where(function ($query) {
                $query->where('titulo', 'like', "%{$this->buscar}%")
                    ->orWhere('estado', 'like', "%{$this->buscar}%")
                    ->orWhere('nombre', 'like', "%{$this->buscar}%");
            })
            ->orderBy($this->campo, $this->orden)
            ->paginate(5);

        $categorias = Category::select('id', 'nombre')->orderBy('nombre')->get();

        return view('livewire.show-user-posts', compact('posts', 'categorias'));
    }

    public function ordenar(string $campo)
    {
        $this->orden = ($this->orden == 'asc') ? 'desc' : 'asc';
        $this->campo = $campo;
    }

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function cambiarEstado(Post $post)
    {
        $this->authorize('update', $post);
        $estado = ($post->estado == "Publicado") ? "Borrador" : "Publicado";

        $post->update([
            'estado' => $estado,
        ]);
    }

    // ------ Métodos para borrar posts --------

    public function confirmarDelete(Post $post) {
        $this->authorize('delete', $post);
        $this->dispatch('onBorrarPost', $post->id);
    }

    #[On('borrarOk')]
    public function eliminarPost(Post $post) {
        $this->authorize('delete', $post);
        if (basename($post->imagen) != 'hug-kiss.gif') {
            Storage::delete($post->imagen);
        }

        $post->delete();
        $this->dispatch('mensaje', 'Post eliminado correctamente');
    }

    // -------- Métodos para editar posts --------
    public function edit(Post $post) {
        $this->authorize('update', $post);

        $this->uform->setPost($post);
        $this->abrirModalUpdate = true;
    }

    public function update() {
        $this->authorize('update', $this->uform->post);

        $this->uform->formUpdate();
        $this->cerrarModal();

        $this->dispatch('mensaje', 'Post editado correctamente');
    }

    public function cerrarModal() {
        $this->uform->formReset();
        $this->abrirModalUpdate = false;
    }

    // -------- Métodos para detalle -----------

    public function abrirDetalle(Post $post) {
        $this->postDetalle = $post;
        $this->abrirModalDetalle = true;
    }

    public function cerrarDetalle() {
        $this->reset('postDetalle', 'abrirModalDetalle');
    }
}
