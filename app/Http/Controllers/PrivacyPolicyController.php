<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    /**
     * Muestra la página de Política de Privacidad.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('privacy-policy');
    }
}
