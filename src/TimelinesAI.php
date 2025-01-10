<?php

namespace Futurum\TimelinesAI;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class TimelinesAI
{
    protected $httpClient;
    protected $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = new Client([
            'base_uri' => 'https://api.timelines.ai/v1/',
            'headers' => [
                'Authorization' => "Bearer {$this->apiKey}",
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function sendMessage(string $phone, string $message): array
    {
        try {
            $response = $this->httpClient->post('messages', [
                'json' => [
                    'phone' => $phone,
                    'message' => $message,
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getBalance(): array
    {
        try {
            $response = $this->httpClient->get('balance');
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getMessageStatus(string $messageId): array
    {
        try {
            $response = $this->httpClient->get("messages/{$messageId}");
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}
