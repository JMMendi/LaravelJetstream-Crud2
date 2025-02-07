<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function pintarFormulario() {
        return view('formcorreos.fcontacto');
    }

    public function procesarFormulario(Request $request) {
        if(Auth::user() != null) {
            $request->validate([
                'nombre' => ['required', 'string', 'min:3', 'max:60'],
                'mensaje' => ['required', 'string', 'min:10', 'max:150'],
            ]);
        } else {
            $request->validate([
                'nombre' => ['required', 'string', 'min:3', 'max:60'],
                'email' => ['email', 'required'],
                'mensaje' => ['required', 'string', 'min:10', 'max:150'],
            ]);
        }

        
        try {
            Mail::to('support@contactos.org')->send(new ContactoMailable($request->nombre, $request->email ?? Auth::user()->email , $request->mensaje));
            return redirect()->route('inicio')->with('mensaje','Formulario enviado');
        } catch(\Exception $ex) {
            // dd("Error al enviar el email: ".$ex->getMessage());
            return redirect()->route('inicio')->with('mensaje', 'No se pudo enviar el mensaje');
        }
    }
}
