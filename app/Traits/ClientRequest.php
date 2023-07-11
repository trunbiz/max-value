<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ClientRequest
{
    public function callClientRequest(string $method, string $url, array $headers = [], array $params = [], $multipart = false, $contentType = 'form-data')
    {
        $client = new Client();
        $method = strtoupper($method);
        $data = [
            'http_errors' => false,
            'verify' => false,
            'headers' => $headers
        ];

        if ($method == 'GET') {
            $data['query'] = $params;
        } else {
            if ($multipart) {
                $data['multipart'] = $params;
            } elseif ($contentType == 'json') {
                $data['json'] = $params;
            } else {
                $data['form_params'] = $params;
            }
        }

        try{
            $response = $client->request($method, $url, $data);
            $data = json_decode($response->getBody()->getContents());
            return [
                'success' => true,
                'message' => 'Request api success',
                'data' => $data
            ];
        }catch (\Exception $e)
        {
            return [
                'success' => false,
                'message' => $e->getMessage() ?? 'Request api error'
            ];
        }
    }
}
