<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Score;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->input('tab', 'add_question');
        $page = $request->input('page', 1);
        
        $questions = Question::paginate(5, ['*'], 'page', $page);
        $scores = Score::with('user')->orderBy('date_taken', 'desc')->paginate(5, ['*'], 'page', $page);
        
        $editQuestion = null;
        if ($request->has('edit_id')) {
            $editQuestion = Question::find($request->edit_id);
            $tab = 'edit_question';
        }
        
        return view('admin.panel', compact('tab', 'questions', 'scores', 'editQuestion'));
    }

    public function storeQuestion(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'answer' => 'required|integer|min:1|max:4',
        ]);

        Question::create($request->all());

        return redirect()->route('admin.panel', ['tab' => 'add_question'])->with('success', 'Question added');
    }

    public function updateQuestion(Request $request, Question $question)
    {
        $request->validate([
            'question' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'answer' => 'required|integer|min:1|max:4',
        ]);

        $question->update($request->all());

        return redirect()->route('admin.panel', ['tab' => 'existing_questions'])->with('success', 'Question updated');
    }

    public function deleteQuestion(Question $question)
    {
        $question->delete();
        return redirect()->route('admin.panel', ['tab' => 'existing_questions'])->with('success', 'Question deleted');
    }
}