<?php

namespace App\Models;

use App\Models\Traits\IsOrderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    use IsOrderable;
    protected $fillable = [
        'uid',
        'name',
        'abv',
        'tagline',
        'description',
        'image_url',
    ];

    public function scopeFilterByHigherABV(Builder $builder, $abv = 0)
    {
        $builder->where('abv', '>', $abv);
    }

    public function scopeFindName(Builder $builder, $name)
    {
        // I believe it's not a good method to filter or find beers , because it's a wild card search query.
        // it's better to query string values with without a wild card (%) at first, but for now we just have to use a wild card query :)
        $builder->where('name', 'LIKE', '%' . strtolower($name) . '%');
    }
}
