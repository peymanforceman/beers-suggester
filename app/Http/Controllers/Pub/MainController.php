<?php

namespace App\Http\Controllers\Pub;

use App\Models\Beer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index()
    {

        return view('dashboard.dashboard')->with(
            [
                'path' => __('trans.Home'),
                'msg' => __('trans.Find your favorite beer to receive a list of similar beers, based on name and ABV!'),
            ]);
    }

    public function suggest(Request $request)
    {
        $this->validate($request, [
            'name' => 'nullable|string',
            'abv' => 'nullable|numeric|between:0,100|max:100',
        ]);

        // if request is available make the query , otherwise just show a form
        if (!is_null($request->name)) {
            $beers = Beer::findName($request->name)
                ->filterByHigherABV(is_null($request->abv) ? 0 : $request->abv)
                ->ordered()
                ->get();
        } else {
            $beers = collect([]);
        }

        return view('dashboard.beers')->with(
            [
                'path' => __('trans.Suggest A Beer'),
                'msg' => __('trans.Find your favorite beer to receive a list of similar beers, based on name and ABV!'),
                'beers' => $beers,
                'request' => $request,
            ]);
    }

    public function api_doc()
    {
        return view('dashboard.api_doc');
    }
}
