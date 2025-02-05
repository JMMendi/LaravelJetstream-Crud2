<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\Form;

class FormUpdatePost extends Form
{
    public ?Post $post = null;

    public string $titulo = "";

    #[Rule(['required', 'min:10', 'max:180', 'string'])]
    public string $contenido = "";

    #[Rule(['required', 'integer', 'exists:categories,id'])]
    public int $category_id = -1;

    #[Rule(['required', 'in:Publicado,Borrador'])]
    public string $estado = "";

    #[Rule(['nullable', 'image', 'max:2048'])]
    public $imagen;

    public function formReset() {
        $this->resetValidation();
        $this->reset();
    }

    public function setPost(Post $post) {
        $this->post = $post;
        $this->titulo = $post->titulo;
        $this->contenido = $post->contenido;
        $this->category_id = $post->category_id;
        $this->estado = $post->estado;
    }

    public function formUpdate() {
        $this->validate();
        $imagenVieja = $this->post->imagen;

        $this->post->update([
            'titulo' => $this->titulo,
            'contenido' => $this->contenido,
            'estado' => $this->estado,
            'category_id' => $this->category_id,
            'user_id' => Auth::user()->id,
            'imagen' => $this->imagen?->store('images/posts-images') ?? $imagenVieja,
        ]);

        if (basename($imagenVieja) != 'hug-kiss.gif' && ($this->imagen)) {
            Storage::delete($imagenVieja);
        }
    }

    public function rules() : array {
        return [
            'titulo' => ['required', 'string', 'min:3', 'max:100', 'unique:posts,titulo,'.$this->post->id],
        ];
    }
}
