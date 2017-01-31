<?php

namespace App\Parsers;

use JonnyW\PhantomJs\Client;

class OnlinerParser implements Parser
{
    const URL = 'http://ab.onliner.by';

    private $client;

    public function __construct()
    {
        $this->client = Client::getInstance();
        $this->client->getEngine()->setPath('/usr/bin/phantomjs');
    }

    public function parse()
    {
        $content = $this->getContent();

        if (!$content) {
            return false;
        }

        $document = new \DOMDocument();

        libxml_use_internal_errors(true);
        $document->loadHTML($content, LIBXML_PARSEHUGE);
        libxml_clear_errors();

        $finder = new \DOMXPath($document);

        $cars = $finder->query("//tr[contains(@class, 'carRow')]");

        $parsedCars = [];
        foreach ($cars as $car) {
            $parsedCars[] = $this->getCarParams($car);
        }

        return $parsedCars;
    }

    private function getCarParams(\DOMElement $car)
    {
        $document = new \DOMDocument();
        $document->loadHTML($car->ownerDocument->saveHTML($car));

        $finder = new \DOMXPath($document);

        $distNode = $finder->query("//*[contains(@class, 'dist')]")->item(0);
        $dist = (int)preg_replace('/[^0-9]/', '',$distNode->textContent);

        $yearNode = $finder->query("//*[contains(@class, 'year')]")->item(0);
        $year = (int)$yearNode->textContent;

        $priceNode = $finder->query("//p[contains(@class, 'small')]/text()[following-sibling::br]")->item(0);
        $price = (int)preg_replace('/[^0-9]/', '', $priceNode->textContent);

        $markNode = $car->getElementsByTagName('h2')->item(0);

        $linkNode = $markNode->getElementsByTagName('a')->item(0);
        $link = self::URL . $linkNode->getAttribute('href');
        $mark = trim($linkNode->getElementsByTagName('strong')->item(0)->nodeValue);

        $hash = md5($dist . $year . $price . $link . $mark);

        return compact('dist', 'year', 'price', 'link', 'mark', 'hash');
    }

    private function getContent()
    {
        $request = $this->client->getMessageFactory()->createRequest(self::URL, 'GET');
        $response = $this->client->getMessageFactory()->createResponse();

        $this->client->send($request, $response);

        if($response->getStatus() === 200) {
            return $response->getContent();
        }

        return false;
    }
}