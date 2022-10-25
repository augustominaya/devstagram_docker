<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store()
    {
        //utilizamos el helper de authenticacion con el metodo de logout
        //pero este metodo de cierre de sesion es muy inserguro, ya que estamos prospenso a ataques
        auth()->logout();
        return redirect()->route('login');
    }
}
