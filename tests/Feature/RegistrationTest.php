<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Product;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
  /** @test */
    public function a_user_can_register(){

        $response =  $this->json('POST', '/api/v2/register',[
            'name' => $name = $this->faker->name,
            'email' => $email = $this->faker->email,
            'password' => $pass = 'password'
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email,
        ]);

           \Log::info($response->getContent());
     }
  /** @test */
     public function can_show_all_product() {
    
      $response =  $this->json('GET', '/api/v2/index')
             ->assertStatus(200)
             ->assertJsonStructure(
                 [
                     'data' => [
                         '*' => [
                             'id',
                             'name',
                             'quantity',
                             'date_created'
                         ]
                     ]
                 ]
             );

             \Log::info($response->getContent());
      }

  /** @test */
      public function can_show_specificdata(){
        // $this->actingAs(Product::factory()->create());

        $product = Product::create([
            'name' => $this->faker->name,
            'quantity' => '10'

        ]);

       $response = $this->json('get', '/api/v2/show/'.$product->id)->assertSuccessful();

        \Log::info($response->getContent());
      }

//   /** @test */
//       public function can_update_product()
//       {
//         //   $this->actingAs($user = User::factory()->create());
  
//         //   $product = Product::factory()->hasAttached($user)->create();

//           $product = Product::create([
//             'name' => $this->faker->name,
//             'quantity' => '8'

//         ]);
//           $this->json('put', '/api/v2/update/'.$product->id, $product)->assertSuccessful();
  
//       }

  /** @test */
      public function can_delete_product()
      {
        //   $this->actingAs(Product::factory()->create());
  
        //   $product = Product::factory()->create();
        $product = Product::create([
            'name' => $this->faker->name,
            'quantity' => '5'

        ]);
         $response = $this->json('delete', '/api/v2/delete/'.$product->id)->assertSuccessful();

          \Log::info($response->getContent());
      }

    //   /** @test */
    // public function a_user_can_login(){

    //     $response =  $this->json('POST', '/api/v2/login',[
    //         'email' => $email = 'marvenn@gmail.com',
    //         'password' => $pass = 'password'
    //     ]);

    //     $response->assertStatus(201);

    //     $this->assertDatabaseHas('users', [
    //         'email' => $email,
    //         'password' => $pass,
    //     ]);
    //        \Log::info($response->getContent());
    //  }
}
