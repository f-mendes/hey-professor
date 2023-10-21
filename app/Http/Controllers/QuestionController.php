<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{RedirectResponse, Request};

class QuestionController extends Controller
{
    public function index(): View
    {
        $questions = user()->questions()->get();

        return view('question.index', compact('questions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'question' => [
                'required',
                'min:10',

                function (string $attribute, mixed $value, Closure $fail) {
                    if (!str_ends_with($value, '?')) {
                        $fail('Are you sure that is a question? Please, check the question mark.');
                    }
                },
            ],
        ]);

        user()->questions()->create(
            [
                'question' => $attributes['question'],
                'draft'    => true,
            ]
        );

        //return redirect()->route('dashboard');
        return back();

    }

    public function destroy(Question $question): RedirectResponse
    {
        $this->authorize('destroy', $question);

        $question->delete();

        return back();
    }
}
