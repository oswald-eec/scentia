<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsController extends Controller
{
    /**
     * Muestra la página de Términos y Condiciones.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('terms');
    }
}
