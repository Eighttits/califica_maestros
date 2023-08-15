<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Form;
use App\Models\Submission;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewStudentRegistration;
use Illuminate\Support\Str;



class StudentController extends Controller
{
    public function index()
    {
        if (Gate::allows('student')) {
            $user = auth()->user(); // Obtén el usuario autenticado
            // Lógica y vista específica para el dashboard del estudiante
            return view('dashboard.student', compact('user'));
        } else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }
    public function viewAddStudent()
    {
        if (Gate::allows('admin')) {
            return view('auth.add-student');
            return redirect()->route('dashboard')->with('success', 'Estudiante agregado correctamente.');
        } else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }
    public function addStudent(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);


        //generar contraseña temporal
        $temporaryPassword = Str::random(10);

        // Crear un nuevo estudiante en la base de datos
        $student = new User();
        $student->name = $validatedData['name'];
        $student->email = $validatedData['email'];
        $student->password = bcrypt($temporaryPassword); // Hashear la contraseña
        $student->role = 'student';
        $student->save();

        // Asignar la contraseña temporal al usuario y guardarlo

        // Enviar el correo electrónico
        Mail::to($student->email)->send(new NewStudentRegistration($student->email, $temporaryPassword));

        return redirect()->route('add-student')->with('success', 'Estudiante agregado correctamente.');
    }

    public function showStudentForm($formId)
    {
        $user = auth()->user();
        
        // Verificar si el usuario ya ha contestado el formulario
        $existingSubmission = Submission::where([
            'user_id' => $user->id,
            'form_id' => $formId,
        ])->first();
        
        // Verificar si el estudiante tiene relación con el maestro asociado al formulario
        $form = Form::findOrFail($formId);
        $teacher = $form->teacher;
        if (!$user->teachers->contains($teacher)) {
            return redirect()->route('student.dashboard')->with('error', 'No tienes permiso para contestar este formulario.');
        }

        return view('forms.student-form', compact('form', 'existingSubmission'));
    }

    public function showStudents()
    {
        $students = User::where('role', 'student')->get();

        return view('students-list', compact('students'));
    }
    
    public function destroy($userId){
        $user = User::findOrFail($userId);
        $submissions = $user->submissions;

        // Eliminar las respuestas de las presentaciones
        foreach ($submissions as $submission) {
            foreach ($submission->answerChoices as $answer) {
                $answer->submission->delete();
                $answer->choice->delete();
                $answer->delete();
            }
            $submission->delete();
        }
    
        // Eliminar las presentaciones  
        $user->teachers()->detach();
        $user->delete();
        return redirect()->route('students.list')->with('success', 'Estudiante eliminado exitosamente.');
    }
}
