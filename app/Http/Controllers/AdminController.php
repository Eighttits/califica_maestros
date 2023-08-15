<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Teacher;
use App\Models\Form;
use App\Models\FormQuestion;
use App\Models\MultipleChoice;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        if (Gate::allows('admin')) {
            // Lógica y vista específica para el dashboard del administrador
            return view('dashboard.admin');
        } else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }

    public function showCreateForm()
    {
        return view('forms.create-form');
    }


    public function showAddTeachersForm()
    {
        $users = User::where('role', 'student')->get(); // Obtén todos los usuarios con rol de estudiante
        $teachers = Teacher::all(); // Obtén todos los profesores disponibles

        return view('forms.student-add-teacher', compact('users', 'teachers'));
    }

    
    public function addTeachersToStudents(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));
        $user->teachers()->sync($request->input('teacher_ids', [])); // Asocia los profesores al usuario

        return redirect()->route('admin.dashboard')->with('success', 'Profesores vinculados a estudiante exitosamente.');
    }
    

}
