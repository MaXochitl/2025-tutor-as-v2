<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Periodo_eval;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $periodos = Periodo_eval::all()->count();
        if ($periodos > 0) {
            $activo = Periodo_eval::where('estado', 1)->count();
            if ($activo > 0) {

                return view('auth.login', compact('activo'));
            }
        } else {
            $activo = 0;
        }
        return view('auth.login', compact('activo'));
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        $user = $request->user();
        if ($user->can('tutorias.home')) {
            return redirect()->route('orientacion.index');
        } else {

            return redirect()->route('reportes_tutor.show', $user->tutor->id);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
