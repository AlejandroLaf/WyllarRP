<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('home');
    }

    protected function authenticated(Request $request)
    {
        // Lógica personalizada de redirección después de iniciar sesión
        return redirect()->route('home');
    }
}
