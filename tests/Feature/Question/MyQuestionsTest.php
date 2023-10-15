<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to list question created by me', function () {

    $wrongUser     = User::factory()->create();
    $wrongQuestion = Question::factory()
        ->for($wrongUser, 'createdBy')
        ->count(10)
        ->create();

    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()
        ->for($user, 'createdBy')
        ->count(10)
        ->create();

    $response = get(route('question.index'));

    foreach ($question as $q) {
        $response->assertSee($q->question);
    }

    foreach ($wrongQuestion as $q) {
        $response->assertDontSee($q->question);
    }
});
