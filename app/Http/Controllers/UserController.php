<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    /**
     * Actualiza los datos del usuario autenticado.
     */
    public function updateAccount(Request $request)
    {
        $user = auth()->user();

        // Validar nombre y correo
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Validar y actualizar la contraseña si fue proporcionada
        if ($request->filled('current_password') || $request->filled('password')) {
            $request->validate([
                'current_password' => 'required',
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
            }

            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Datos actualizados correctamente.');
    }


    public function sendHelp(Request $request)
{
    $user = auth()->user();
    $cacheKey = 'help_email_sent_' . $user->id;

    // Verificar si el usuario ha enviado en los últimos 30 minutos
    if (Cache::has($cacheKey)) {
        return back()->with('error', 'Ya enviaste una solicitud. Por favor espera 30 minutos para volver a enviar.');
    }

    // Validar campos
    $request->validate([
        'subject' => 'required|string|max:255',
        'message' => 'required|string|max:1000',
    ]);

    // Enviar correo
    Mail::raw("Usuario: {$user->name} ({$user->email})\n\nMensaje:\n{$request->message}", function ($message) use ($request) {
        $message->to('martinezjjj8@gmail.com')
                ->subject('[Solicitud de Ayuda] ' . $request->subject);
    });

    // Limitar a 30 minutos
    Cache::put($cacheKey, true, now()->addMinutes(30));

    return back()->with('success', 'Tu solicitud fue enviada correctamente. Responderemos lo antes posible.');
}

}
