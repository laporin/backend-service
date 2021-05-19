<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Report::class;

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Report $report) {
            //
        })->afterCreating(function (Report $report) {
            $url = 'https://source.unsplash.com/random/600x400?topics=nature?sig=123';
            $report
               ->addMediaFromUrl($url)
               ->toMediaCollection('reports');
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'serial' => $this->faker->lexify('id-????????'),
            'user_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'detail' => $this->faker->text(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'subdistrict' => $this->faker->streetName(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'private' => $this->faker->boolean(20),
        ];
    }
}
