<?php

namespace Database\Factories;

use App\Models\Figure;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Figure>
 */
class FigureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Figure::class;
     public function definition()
    {
        return [
            'ten' => fake()->sentence(5),
            'gia' => fake()->numberBetween(100, 10000)*1000,
            'so_luong_hien_con' => fake()->numberBetween(10, 50),
            'so_luong_da_ban' => fake()->numberBetween(0, 10),
            'nha_sx' => fake()->company,
            'chieu_cao' => fake()->numberBetween(50, 200),
            'chieu_rong' => fake()->numberBetween(50, 200),
            'chieu_dai' => fake()->numberBetween(50, 200),
            'chat_lieu' => fake()->randomElement(['Nhựa PVC', 'Nhựa ABS', 'Nhựa Vinly','Nhựa Poly','Gốm','Gỗ','Kim loại']),
            'mo_ta' => fake()->paragraph,
            'hinh_anh' => fake()->imageUrl()
        ];
    }
}
