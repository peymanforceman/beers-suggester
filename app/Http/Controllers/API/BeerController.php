<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\BeerResource;
use App\Models\Beer;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class BeerController extends Controller
{
    public function suggest_beers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'abv' => 'nullable|numeric|between:0,100|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err' => 1,
                'msg' => __('trans.Error wrong Parameters')
            ], 400);
        }

        if (Beer::first() == null) {
            $response = $this->update_beers();
        }

        return BeerResource::collection(
            Beer::findName($request->name)
                ->filterByHigherABV(is_null($request->abv) ? 0 : $request->abv)
                ->ordered()
                ->get()
        );
    }

    public function update_beers()
    {
        $page = 1;
        $ended = false;
        $client = new Client();
        $URI = 'https://api.punkapi.com/v2/';

        Beer::truncate();
        while ($ended == false) {
            try {
                $response = $client->request('GET', $URI . '/beers?per_page=60&page=' . $page);
            } catch (ConnectException $exception) {
                return response()->json([
                    'error' => 1,
                    'msg' => $exception->getMessage()
                ], 400);
            }
            $response_json = collect(json_decode($response->getBody()->getContents(), true));
            if ($response_json->isEmpty()) {
                $ended = true;
            } else {
                // fetch data and continue requesting :)
                foreach ($response_json as $beer_data) {
                    Beer::create([
                        'uid' => $beer_data['id'],
                        'name' => strtolower($beer_data['name']),
                        'description' => strtolower($beer_data['description']),
                        'tagline' => strtolower($beer_data['tagline']),
                        'abv' => $beer_data['abv'],
                        'image_url' => $beer_data['image_url'],
                    ]);
                }

                $page++;
            }
        }

        return response()->json([
            'success' => 1,
            'msg' => __('trans.Data has been updated successfully')
        ]);

    }

}