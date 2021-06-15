<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i=0; $i < 10; $i++){
            Product::create([
                'name' =>  $faker->name,
                'quantity' =>  $faker->randomElement(['15','2','8','6','12','6','3','25','9','10','11']) 
            ]);
        }
    }
}
