<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $attributes = $request->validate([
            'question' => 'required|min:10'
        ]);

        Question::query()->create($attributes);

        //return redirect()->route('dashboard');
        return to_route('dashboard');

    }
}
