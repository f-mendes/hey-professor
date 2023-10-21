<?php

use App\Models\{Question, User};

use function Pest\Laravel\put;

it('should be able to publish a question', function () {
    //Arrange
    $user = User::factory()->create();
    $this->actingAs($user);
    $question = Question::factory()->create(['draft' => true, 'created_by' => $user->id]);

    //Act
    put(Route('question.publish', $question))
        ->assertRedirect();
    $question->refresh();

    //Assert
    expect($question)->draft->toBe(false);

});

it('should make sure that only the created the question can publish the question', function () {
    //Arrange
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();
    $question  = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);

    //Act
    $this->actingAs($wrongUser);
    //Assert
    put(Route('question.publish', $question))
        ->assertForbidden();

    //Act
    $this->actingAs($rightUser);
    //Assert
    put(Route('question.publish', $question))
        ->assertRedirect();

});
