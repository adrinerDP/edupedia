<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\InfoParser;
use App\Services\ReturnAPI;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    private $api, $parser;

    public function __construct()
    {
        $this->api = new ReturnAPI();
        $this->parser = new InfoParser();
    }

    public function getByName($name)
    {
        $searchResult = $this->parser->search($name);

        if (is_null($searchResult)) {
            return $this->api->code(404)->message('Not Found')->return();
        } else {
            return $this->api->return($searchResult);
        }
    }
}
