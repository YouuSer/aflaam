<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTvTest extends TestCase
{
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function the_tv_page_shows_correct_info()
    {
        $response = $this->get(route('tv.index'));

        $response->assertStatus(200);
    }
}
