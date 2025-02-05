<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index() {
        $posts = Post::with('user', 'category')->
        where('estado', 'Publicado')
        ->orderBy('id', 'desc')
        ->paginate(5);
        
        return view('welcome', compact('posts'));
    }
}
