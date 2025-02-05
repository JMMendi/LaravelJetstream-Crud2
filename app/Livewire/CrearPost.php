<?php

namespace App\Livewire;

use App\Livewire\Forms\FormCrearPost;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearPost extends Component
{
    use WithFileUploads;

    public bool $abrirModalCrear = false;

    public FormCrearPost $cform;

    public function render()
    {
        $categorias = Category::select('nombre', 'id')->orderBy('nombre')->get();
        return view('livewire.crear-post', compact('categorias'));
    }

    public function store() {
        $this->cform->formStorePost();
        $this->cerrarModal();

        $this->dispatch('onPostCreado')->to(ShowUserPosts::class);
        $this->dispatch('mensaje', 'Post Creado');
    }

    public function cerrarModal() {
        $this->cform->formReset();
        $this->abrirModalCrear = false;
    }
}
