<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Muestra la pantalla principal para el cliente autenticado.
     */
    public function index()
    {
        // Cambia 'frontend.cliente' por la ruta real de tu vista 
        // (por ejemplo: 'cliente.index', 'home', etc.)
        return view('frontend.heladeriaglaceCliente'); 
    }
}