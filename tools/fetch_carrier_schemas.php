<?php

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client as GuzzleClient;

function getCouriers()
{
    $data = json_decode(file_get_contents(__DIR__ . '/../resources/schemas/com.postmen.api/slug.json'), true);

    foreach ($data['enum'] as $courier) {
        yield $courier;
    }
}

function main(): int
{
    $client = new GuzzleClient([
        'base_uri' => 'https://secure.postmen.com/json/couriers/',
    ]);

    foreach (getCouriers() as $courier) {
        try {
            $response = $client->get($courier);
            $json = \GuzzleHttp\json_decode((string) $response->getBody());

            file_put_contents(
                __DIR__ . "/../resources/schemas/carriers/{$courier}.json",
                \GuzzleHttp\json_encode($json, JSON_PRETTY_PRINT)
            );
        } catch (Exception $exception) {
            // Worry not!
        }
    }

    return 0;
}

exit(main());
