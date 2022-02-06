<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class BreakingBadCharacterApi {

    protected $_base = 'https://breakingbadapi.com/api/';

    public function __construct()
    {
    }

    public function characters() {

        return $this->fetch('/characters');
    }

    public function character( $id ) : array
    {
        return $this->fetch('/characters/' . $id)[0];
    }

    protected function fetch( $uri ) : array
    {
        $response = Http::get($this->_base . trim($uri, '/'));
        return json_decode($response->body(), true);
    }
}
