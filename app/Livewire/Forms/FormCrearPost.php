<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCrearPost extends Form
{
    #[Validate(['required', 'string', 'min:3', 'max:100', 'unique:posts,titulo'])]
    public string $titulo = "";

    #[Validate(['required', 'min:10', 'max:180', 'string'])]
    public string $contenido = "";

    #[Validate(['required', 'integer', 'exists:categories,id'])]
    public int $category_id = -1;

    #[Validate(['required', 'in:Publicado,Borrador'])]
    public string $estado = "";

    #[Validate(['nullable', 'image', 'max:2048'])]
    public $imagen;

    public function formStorePost() {
        $this->validate();

        Post::create([
            'titulo' => $this->titulo,
            'contenido' => $this->contenido,
            'estado' => $this->estado,
            'category_id' => $this->category_id,
            'user_id' => Auth::user()->id,
            'imagen' => $this->imagen?->store('images/posts-images') ?? 'images/posts-images/hug-kiss.gif',
        ]);
    }

    public function formReset() {
        $this->resetValidation();
        $this->reset();
    }
}
