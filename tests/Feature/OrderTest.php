<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function testPackWidgets()
    {
        // Test with order size 1
        $response = $this->post(route('pack.widgets'), ['orderSize' => 1]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'packs' => [250],
            ]);

        // Test with order size 250
        $response = $this->post(route('pack.widgets'), ['orderSize' => 250]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'packs' => [250],
            ]);

        // Test with order size 251
        $response = $this->post(route('pack.widgets'), ['orderSize' => 251]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'packs' => [500],
            ]);

        // Test with order size 500
        $response = $this->post(route('pack.widgets'), ['orderSize' => 500]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'packs' => [500],
            ]);

        // Test with order size 501
        $response = $this->post(route('pack.widgets'), ['orderSize' => 501]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'packs' => [500, 250],
            ]);

        // Test with order size 750
        $response = $this->post(route('pack.widgets'), ['orderSize' => 750]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'packs' => [500, 250],
            ]);

        // Test with order size 751
        $response = $this->post(route('pack.widgets'), ['orderSize' => 751]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'packs' => [1000],
            ]);

        // Test with order size 1000
        $response = $this->post(route('pack.widgets'), ['orderSize' => 1000]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'packs' => [1000],
            ]);

        // Test with order size 1001
        $response = $this->post(route('pack.widgets'), ['orderSize' => 1001]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'packs' => [1000, 250],
            ]);

        // Test with order size 2000
        $response = $this->post(route('pack.widgets'), ['orderSize' => 2000]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'packs' => [2000],
            ]);

        // Test with order size 2001
        $response = $this->post(route('pack.widgets'), ['orderSize' => 2001]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'packs' => [2000, 250],
            ]);

        // Test with order size 5000
        $response = $this->post(route('pack.widgets'), ['orderSize' => 5000]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'packs' => [5000],
            ]);

        // Test with order size 5001
        $response = $this->post(route('pack.widgets'), ['orderSize' => 5001]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'packs' => [5000, 250],
            ]);
    }
}
