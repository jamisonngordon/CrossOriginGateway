<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrossOriginPassThroughController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required',
            'headers' => 'sometimes',
            'data' => 'sometimes'
        ]);

        $json = $request->all();

        $client = new \GuzzleHttp\Client(['headers' => $json["headers"]]);

        $response = $client->request('GET',  $json["url"]);
        $data = $response->getBody()->getContents();
        return response($data, 200)->header('Content-Type', 'application/json');
    }
}
