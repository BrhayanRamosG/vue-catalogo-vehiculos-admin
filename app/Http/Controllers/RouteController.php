<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class RouteController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
    public function dashboard()
    {
        return Inertia::render('Dashboard');
    }
    public function cotizador()
    {
        return Inertia::render('Cotizador');
    }
    public function informacion_vehiculos()
    {
        return Inertia::render('InformacionVehiculos');
    }
}