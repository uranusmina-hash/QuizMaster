<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Score;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function show(Request $request)
    {
        if (!session()->has('quiz_answers')) {
            session(['quiz_answers' => []]);
        }

        $answers = session('quiz_answers');

        $questions = Question::paginate(5);

        return view('quiz.take', [
            'questions' => $questions,
            'answers' => $answers,
            'totalQuestions' => Question::count()
        ]);
    }

    public function saveAnswers(Request $request)
    {
        $answers = session('quiz_answers', []);

        if ($request->has('answers')) {
            foreach ($request->answers as $questionId => $answer) {
                $answers[$questionId] = $answer;
            }
        }

        session(['quiz_answers' => $answers]);

        return redirect()->route('quiz.show', [
            'page' => $request->page ?? 1
        ]);
    }

    public function submit(Request $request)
    {
        $answers = session('quiz_answers', []);

        if ($request->has('answers')) {
            foreach ($request->answers as $questionId => $answer) {
                $answers[$questionId] = $answer;
            }
        }

        session(['quiz_answers' => $answers]);

        $totalQuestions = Question::count();

        if (count($answers) < $totalQuestions) {
            return redirect()->route('quiz.show')
                ->with('error', 'Please answer all questions before submitting.');
        }

        $score = 0;
        foreach (Question::all() as $question) {
            if (
                isset($answers[$question->id]) &&
                intval($answers[$question->id]) === intval($question->answer)
            ) {
                $score++;
            }
        }

        Score::create([
            'user_id' => auth()->id(),
            'score' => $score,
            'total' => $totalQuestions,
        ]);

        session()->forget('quiz_answers');

        return redirect()->route('quiz.results')
            ->with('success', "You scored $score out of $totalQuestions");
    }

    public function results()
    {
        $scores = Score::where('user_id', auth()->id())
            ->latest()
            ->paginate(5);

        return view('quiz.results', compact('scores'));
    }
}
