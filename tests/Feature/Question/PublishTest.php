<?php

use App\Models\{Question, User};

use function Pest\Laravel\put;

it('should be able to publish a question', function () {
    //Arrange
    $user = User::factory()->create();
    $this->actingAs($user);
    $question = Question::factory()->create(['draft' => true]);

    //Act
    put(Route('question.publish', $question))
        ->assertRedirect();
    $question->refresh();

    //Assert
    expect($question)->draft->toBe(false);

});
