<?php

use App\Models\{Question, User};

use function Pest\Laravel\post;

it('should be able to vote a question', function () {
    //Arrange
    $user = User::factory()->create();
    $this->actingAs($user);
    $question = Question::factory()->create();

    //Act
    post(Route('question.like', $question->id))
        ->assertRedirect();

    //Assert
    $this->assertDatabaseHas('votes', [
        'user_id'     => $user->id,
        'question_id' => $question->id,
        'like'        => 1,
        'unlike'      => 0,
    ]);

});

it('should be able to vote a question only once', function () {
    //Arrange
    $user = User::factory()->create();
    $this->actingAs($user);
    $question = Question::factory()->create();

    //Act
    post(Route('question.like', $question->id))
        ->assertRedirect();

    post(Route('question.like', $question->id))
        ->assertRedirect();

    //Assert
    expect($user->votes()->where('question_id', $question->id)->count())->toBe(1);

});
