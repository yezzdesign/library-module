<?php

namespace Modules\Library\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Library\Entities\Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //'post_id'   =>  rand(1,10),
            'title'     =>  $this->faker->realText(100),
            'author'    =>  $this->faker->name,
            'publisher' =>  $this->faker->company,
            'blurb'     =>  $this->faker->realTextBetween(200, 400),
            'active_state'  =>  rand(0,1),
            'read_date' =>  (rand(0,1)) ? $this->faker->dateTimeBetween('-2 years') : null,
            'pages'     =>  rand(200,500),
            'genre'     =>  $this->faker->colorName,
        ];
    }
}

