<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TodoList>
 */
class TodoListFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'completed' => $this->faker->boolean,
            'user_id' => null,
        ];
    }

    public function forUser($userId)
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $userId,
        ]);
    }
}
