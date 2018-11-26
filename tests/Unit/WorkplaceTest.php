<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkplaceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShouldReturnAllWorkplaces()
    {
      $this->get('/api/workplaces')
      ->assertJsonStructure([[
        "title",
        "price",
        "address",
        "latitude",
        "longitude",
        "image",
        "user_id",
        "user"=>[
          "name",
          "email",
          "phone",
        ]
        ]]);
    }

    public function testShouldReturnAWorkplace()
    {
      $this->get('/api/workplace/1')
      ->assertJsonStructure([
        "title",
        "price",
        "address",
        "latitude",
        "longitude",
        "image",
        "user_id",
        "user"=>[
          "name",
          "email",
          "phone",
        ]
        ]);
    }

    public function testShouldAddWorkplace()
    {
        $this->json('POST', '/api/workplace', ['title' => 'Unit test','price'=>2000,'user_id'=>1])
             ->assertStatus(201);
    }

    public function testShouldFailAddWorkplace()
    {
        $this->json('POST', '/api/workplace', ['price'=>2000,'user_id'=>1])
             ->assertStatus(422);
    }

    public function testShouldUpdateWorkplace()
    {
        $this->json('POST', '/api/workplace/2', ['title' => 'Unit test update','price'=>2000,'user_id'=>1,'_method'=>'put'])
             ->assertStatus(200);
    }

    public function testShouldFailUpdateWorkplace()
    {
        $this->json('POST', '/api/workplace/2', ['title' => 'Unit test update <>>><','price'=>2000,'user_id'=>1,'_method'=>'put'])
             ->assertStatus(422);
    }
}
