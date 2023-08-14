<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        if (Gate::allows('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif (Gate::allows('student')) {
            return redirect()->route('student.dashboard');
        } else {
            return view('dashboard'); // Vista por defecto si no tiene un rol específico
        }
    }
}
