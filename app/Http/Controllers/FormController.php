<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\AnswerChoice;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\FormQuestion;
use App\Models\MultipleChoice;

class FormController extends Controller
{
    public function saveSubmitForm($formId, Request $request)
    {
        // Obtén el usuario autenticado
        $user = auth()->user();

        // Crear una nueva instancia de Submission y guardarla en la base de datos
        $submission = new Submission([
            'user_id' => $user->id,
            'form_id' => $formId,
        ]);
        $submission->save();

        // Recorrer y guardar las respuestas enviadas por el formulario
        foreach ($request->input('answers', []) as $questionId => $answerText) {
            $answer = new AnswerChoice([
                'multiple_choice_id' => intval($answerText),
                'question_id' => $questionId,
                'submission_id' => $submission->id,
            ]);
            $answer->save();
        }

        return redirect()->route('student.dashboard')->with('success', 'Respuestas enviadas exitosamente.');
    }

    public function showForms()
    {
        $forms = Form::all();

        return view('forms', compact('forms'));
    }

    public function editForm($formId)
    {
        $form = Form::findOrFail($formId);

        return view('forms.edit-form', compact('form'));
    }

    public function updateForm($formId, Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'questions.*' => 'required|string|max:255',
            'answers.*.*' => 'required|string|max:255',
        ]);

        // Obtener el formulario existente
        $form = Form::findOrFail($formId);

        // Actualizar el título y la descripción del formulario
        $form->title = $validatedData['title'];
        $form->description = $validatedData['description'];
        $form->save();

        // Actualizar preguntas y respuestas
        foreach ($validatedData['questions'] as $questionId => $questionText) {
            $formQuestion = FormQuestion::findOrFail($questionId);
            $formQuestion->question = $questionText;
            $formQuestion->save();

            foreach ($validatedData['answers'][$questionId] as $choiceId => $answerText) {
                $multipleChoice = MultipleChoice::findOrFail($choiceId);
                $multipleChoice->answer = $answerText;
                $multipleChoice->save();
            }
        }

        return redirect()->route('forms.edit', $formId)->with('success', 'Formulario actualizado exitosamente.');
    }

    public function showViewFormSelection()
    {
        $forms = Form::all();
        return view('forms.select-form', compact('forms'));
    }
    
    public function showFormSelection(Request $request)
    {
        $selectedFormId = $request->input('form_id');
    
        if ($selectedFormId) {
            return redirect()->route('forms.statistics', ['formId' => $selectedFormId]);
        } else {
            return redirect()->route('forms.statistics.select')->with('error', 'Debes seleccionar un formulario.');
        }
    }
    


    public function showStatistics($formId)
    {
        $forms = Form::all();
        $form = Form::findOrFail($formId);
        $questions = $form->formQuestions;
    
        $statistics = [];
    
        foreach ($questions as $question) {
            $questionData = [
                'question' => $question->question,
                'choices' => [],
            ];
    
            $choices = $question->multipleChoices;
            foreach ($choices as $choice) {
                $choiceCount = $choice->answerChoices->count(); // Usar la relación para contar las respuestas
    
                $questionData['choices'][] = [
                    'choice' => $choice->answer,
                    'count' => $choiceCount,
                ];
            }
    
            $statistics[] = $questionData;
        }
    
        return view('forms.select-form', compact('form', 'statistics', 'forms'));
    }
    



}

