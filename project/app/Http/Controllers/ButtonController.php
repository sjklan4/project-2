<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ButtonController extends Controller
{
    public function handleButtonClick(Request $request)
    {
        // Realiza las acciones necesarias cuando se hace clic en el Botón 1
        
        // Devuelve una respuesta, si es necesario
        return response()->json(['success' => true]);
    }
}
