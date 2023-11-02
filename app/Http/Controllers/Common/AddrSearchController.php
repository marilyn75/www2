<?php

namespace App\Http\Controllers\Common;

use Meilisearch\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddrSearchController extends Controller
{
    public function search(Request $request)
    {
        $results = null;

        $limit = ($request->limit)?$request->limit:15;

        if ($query = $request->get('query')) {
            $client = new Client(config('scout.meilisearch.host'), config('scout.meilisearch.key'));
            $index = $client->index('ADDRSEARCH');

            // $client->index('ADDRSEARCH')->updateFilterableAttributes(['pnucode']);
            // $client->index('ADDRSEARCH')->updateSearchableAttributes(['jibun', 'road']);
            // dd($index->getSettings());
            $results = $index->search($query)->toArray();

        }

        cookie('searchList', '955456|95456');

        return $results['hits'];
    }

    public function bookmark(Request $request)
    {
       dd(cookie());
    }
}
