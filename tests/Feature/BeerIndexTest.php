<?php

namespace Tests\Feature\Categories;

use App\Models\Beer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BeerIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_update_database_from_api()
    {

        $this->json('GET', 'api/v1/update')->assertJsonFragment(
            [
                'success' => 1
            ]
        );


        // second assertion , check that database is not empty , so we know that data has been updated after being truncate

        $beers = Beer::get();
        $this->assertEquals(false, $beers->isEmpty());
    }

    public function test_it_suggest_a_beer_by_name()
    {
        $beer = factory(Beer::class)->create();

        $this->json('GET', 'api/v1/suggest?name=' . $beer->name)->assertJsonFragment(
            [
                'name' => $beer->name
            ]
        );
    }

    public function test_it_suggest_a_beer_by_name_filtered_by_higher_abv()
    {
        $name = 'beer';
        $beer_first = factory(Beer::class)->create([
            'name' => $name . ' 1',
            'abv' => 2,
        ]);

        $beer_second = factory(Beer::class)->create([
            'name' => $name . ' 2',
            'abv' => 4,
        ]);

        $beer_third = factory(Beer::class)->create([
            'name' => $name . ' 3',
            'abv' => 10,
        ]);

        $this->json('GET', 'api/v1/suggest?name=' . $name . '&abv=5')->assertJsonFragment(
            [
                'name' => $beer_third->name
            ]
        );
    }

    public function test_it_return_data_sorted_by_abv_asc()
    {
        $name = 'beer';
        $beer_first = factory(Beer::class)->create([
            'name' => $name . ' 1',
            'abv' => 2,
        ]);

        $beer_second = factory(Beer::class)->create([
            'name' => $name . ' 2',
            'abv' => 4,
        ]);

        $beer_third = factory(Beer::class)->create([
            'name' => $name . ' 3',
            'abv' => 10,
        ]);

        $this->json('GET', 'api/v1/suggest?name=' . $name)->assertSeeInOrder([
            $beer_first->name, $beer_second->name, $beer_third->name
        ]);
    }
}