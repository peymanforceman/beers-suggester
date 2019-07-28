<?php

namespace Tests\Unit\Models;

use App\Models\Beer;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;


class BeerTest extends TestCase
{
    public function test_it_be_find_by_name()
    {
        $beer = factory(Beer::class)->create();

        $this->assertEquals($beer->name, Beer::findName($beer->name)->first()->name);

    }

    public function test_it_be_filter_by_abv()
    {
        $beer_first = factory(Beer::class)->create([
            'abv' => 2,
        ]);

        $beer_second = factory(Beer::class)->create([
            'abv' => 4,
        ]);

        $this->assertEquals($beer_second->name, Beer::filterByHigherABV(2)->first()->name);

    }

    public function test_it_be_ordered_by_abv_asc()
    {
        $beer_first = factory(Beer::class)->create([
            'abv' => 2,
        ]);

        $beer_second = factory(Beer::class)->create([
            'abv' => 4,
        ]);

        $beer_third = factory(Beer::class)->create([
            'abv' => 10,
        ]);

        $this->assertEquals($beer_first->name, Beer::ordered()->first()->name);

    }

    public function test_it_be_ordered_by_abv_desc()
    {
        $beer_first = factory(Beer::class)->create([
            'abv' => 2,
        ]);

        $beer_second = factory(Beer::class)->create([
            'abv' => 4,
        ]);

        $beer_third = factory(Beer::class)->create([
            'abv' => 10,
        ]);

        $this->assertEquals($beer_third->name, Beer::ordered('abv', 'desc')->first()->name);
    }
}