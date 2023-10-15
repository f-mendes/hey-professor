<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('should be able to create a new question bigger than 255 characters', function () {
    //arrange => preparar

    $user = User::factory()->create();
    actingAs($user);

    //act => agir

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ])->assertRedirect();

    //assert => verificar
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', [
        'question' => str_repeat('*', 260) . '?',
    ]);

});

it('should check if ends with question mark ?', function () {
    //arrange => preparar

    $user = User::factory()->create();
    actingAs($user);

    //act => agir

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 10),
    ]);

    //assert => verificar

    $request->assertSessionHasErrors(['question' => 'Are you sure that is a question? Please, check the question mark.']);
    assertDatabaseCount('questions', 0);
});

it('should have at least 10 characters', function () {

    //arrange => preparar

    $user = User::factory()->create();
    actingAs($user);

    //act => agir

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    //assert => verificar

    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['attribute' => 'question', 'min' => 10])]);
    assertDatabaseCount('questions', 0);

});

it('should create as a draft all the time', function () {

    //arrange => preparar

    $user = User::factory()->create();
    actingAs($user);

    //act => agir

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    //assert => verificar

    assertDatabaseHas('questions', [
        'question' => str_repeat('*', 260) . '?',
        'draft'    => true,
    ]);

});

test('only authenticate user can create a question', function () {

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    $request->assertRedirect(route('login'));

});
