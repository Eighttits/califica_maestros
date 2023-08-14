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

    public function createForm(Request $request)
    {
        // Validar los datos del formulario (título, descripción, preguntas, respuestas)
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'teacher' => 'required|string|max:255', // Asegúrate de que el campo exista en tu formulario
            'questions.*' => 'required|string|max:255',
            'answers.*.*' => 'required|string|max:255',
        ]);

        // dd($validatedData);
    
        $teacher = new Teacher();
        $teacher->name = $validatedData['teacher'];
        $teacher->save();
    
        // Crear una nueva instancia de formulario y guardarla
        $form = new Form();
        $form->title = $validatedData['title'];
        $form->description = $validatedData['description'];
        $form->teacher_id = $teacher->id; // Asociar el maestro al formulario
        $form->save();
    
        foreach ($validatedData['questions'] as $questionId => $questionText) {
            $formQuestion = new FormQuestion();
            $formQuestion->question = $questionText;
            $formQuestion->form_id = $form->id; // Asociar la pregunta al formulario
            $formQuestion->save();
            
            foreach ($validatedData['answers'][$questionId] as $answerText) {
                $multipleChoice = new MultipleChoice();
                $multipleChoice->answer = $answerText;
                $multipleChoice->form_question_id = $formQuestion->id; // Asociar la respuesta a la pregunta
                $multipleChoice->save();
            }
        }
    
        return redirect()->route('create-form')->with('success', 'Formulario creado Exitosamente.');
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
