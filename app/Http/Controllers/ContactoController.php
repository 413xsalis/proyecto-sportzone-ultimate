<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'telefono' => 'nullable|string|max:20',
            'mensaje' => 'required|string',
        ]);

        // Guardar en la base de datos
        Contacto::create($request->all());

        // (Opcional) Enviar correo
        /*
        Mail::raw("Nuevo mensaje de {$request->nombre}:\n\n{$request->mensaje}", function ($message) use ($request) {
            $message->to('tu_correo@ejemplo.com')
                    ->subject('Nuevo mensaje de contacto');
        });
        */

        return back()->with('success', '¡Gracias por tu mensaje! Te contactaremos pronto.');
    }
}
