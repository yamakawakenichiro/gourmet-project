<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomDigitNotNull(), // ランダムなユーザーID（関連がある場合） 
            'shop_name' => fake()->company(), // 会社名を利用 
            'name' => fake()->word(), // 単語を利用 
            'price' => fake()->numberBetween(100, 10000), // 価格をランダムに生成 
            'count' => fake()->randomNumber(1), // 数量をランダムに生成 
        ];
    }
}
