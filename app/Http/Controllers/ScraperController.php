<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScraperController extends Controller
{
    public function index(Request $request)
{
    $client = new Client();
    
    $website = $client->request('GET', $request);

    $len = len($data);
    for( $i = 0; $i < $len; $i++)
    {
        $site = $data[i];
        $website = $client->request('GET', $site);
        $companies = $website->filter('.company')->each(function ($node) {
            return [
                'first_item' => $node->children()->eq(0)->text(),
            ];
        });
    }
    
    return $website->html();
}
}
