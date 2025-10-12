<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Contact::class;


    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'gender'     => $this->faker->randomElement([0, 1, 2]), // 0=男性, 1=女性, 2=その他
            'email'      => $this->faker->unique()->safeEmail,
            'tel'        => $this->faker->phoneNumber,
            'address'    => $this->faker->address,
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id ?? 1,
            'detail'     => $this->faker->sentence,
        ];
    }
}
