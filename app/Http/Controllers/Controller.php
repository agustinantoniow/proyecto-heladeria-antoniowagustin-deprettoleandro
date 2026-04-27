<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}
return redirect('/exito')->with('nombre', $request->input('nombre'))
                         ->with('email', $request->input('email'));