<?php

namespace AppBundle\Classes;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class JokeApi
 * @package AppBundle\Classes
 */
class JokeApi
{
    /**
     * @param string $url
     * @return string
     * @throws GuzzleException
     */
    private function getContent(string $url): string
    {
        $client = new Client(['base_uri' => '$url']);

        return $client->request('GET', $url)->getBody();
    }

    /**
     * @return mixed
     * @throws GuzzleException
     */
    public function getSelect()
    {
        return json_decode($this->getContent('http://api.icndb.com/categories'), true);
    }

    /**
     * @param string $category
     * @return mixed
     * @throws GuzzleException
     */
    public function getRandomJoke(string $category)
    {
        $joke = json_decode(
            $this->getContent("http://api.icndb.com/jokes/random?limitTo=[$category]"),
            true
        );

        return nl2br($joke['value']['joke']);
    }
}