<?php
use App\Models\{Question, User};

it('should list all the questions', function () {
    //Arrange
    $user = User::factory()->create();
    $this->actingAs($user);

    $questions = Question::factory()->count(3)->create();

    //Act

    $response = $this->get(Route('dashboard'));

    //Assert

    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }
});
