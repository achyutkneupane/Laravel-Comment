<?php

namespace AchyutN\LaravelComment\Factories;

use AchyutN\LaravelComment\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'commenter_type' => config('comment.commenter_model'),
            'commenter_id' => (config('comment.commenter_model'))::all()->random()->id,
            'content' => $this->faker->text,
            'approved_at' => null,
        ];
    }

    /**
     * Indicate that the model's comment has been approved.
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'approved_at' => now(),
        ]);
    }

    /**
     * Indicate that the model's comment are pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'pending' => true,
        ]);
    }
}