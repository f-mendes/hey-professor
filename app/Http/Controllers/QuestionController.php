<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Closure;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $attributes = $request->validate([
            'question' => [
                'required',
                'min:10',

                function (string $attribute, mixed $value, Closure $fail) {
                    if (substr($value, -1) !== '?') {
                        $fail('Are you sure that is a question? Please, check the question mark.');
                    }
                },
            ],
        ]);

        Question::query()->create($attributes);

        //return redirect()->route('dashboard');
        return to_route('dashboard');

    }
}
