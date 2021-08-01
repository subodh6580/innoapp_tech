<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'invoice_number' => $this->faker->randomNumber(6),
            'customer_id'=>rand(1,200),
            'status'=>$this->faker->randomElement(['new','processed']),
            'total_amount' => $this->faker->randomNumber(3),
        ];
    }
}
