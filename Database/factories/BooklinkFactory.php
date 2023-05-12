<?php

namespace Modules\Library\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BooklinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Library\Entities\Booklink::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'book_id'   =>   rand(1,100),
            'link_name' =>  $this->faker->word,
            'link_address'  =>  'https://www.'.$this->faker->word.'.de',
            'link_icon' =>  null,
        ];
    }
}

