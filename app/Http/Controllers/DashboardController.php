<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        return view('dashboard', [
            'questions' => Question::withSum('votes', 'like')
                    ->withSum('votes', 'unlike')
                    ->get(),
        ]);
    }
}
