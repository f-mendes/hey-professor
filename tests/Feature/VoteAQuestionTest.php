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
