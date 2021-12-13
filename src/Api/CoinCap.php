<?php

namespace App\Api;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class CoinCap
{
    private const BASE_API = 'https://api.coincap.io/v2';

    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getAssets(): array
    {
        $response = $this->client->request('GET', self::BASE_API . '/assets');

        $data = $response->toArray()['data'];

        $labels = [];
        $values = [];

        foreach ($data as $item) {
            $labels[] = $item['id'];
            $values[] = $item['priceUsd'];
        }

        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }

    public function getError(): array
    {
        $response = $this->client->request('GET', self::BASE_API . '/assets');
        if (200 !== $response->getStatusCode()) {
            throw new \Exception('Error');
        }
        try {
            $data = $response->toArray()['data'];

            $labels = [];
            $values = [];

            foreach ($data as $item) {
                $labels[] = $item['id'];
                $values[] = $item['priceUsd'];
            }

            return [
                'labels' => $labels,
                'values' => $values,
            ];
        } catch (\Exception $e) {
            throw new \Exception('Error');
        }
    }
}
