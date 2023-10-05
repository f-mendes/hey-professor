<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

it('should be able to create a new question bigger than 255 characters', function () {
    //arrange => preparar

    $user = User::factory()->create();
    actingAs($user);

    //act => agir

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?'
    ]);

    //assert => verificar

    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', [
        'question' => str_repeat('*', 260) . '?'
    ]);

});

it('should check if ends with question mark ?', function () {

});

it('should have at least 10 characters', function () {

});