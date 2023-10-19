<?php

namespace App\Traits;

use App\Models\Helper;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

trait ClientRequest
{
    public function callClientRequest(string $method, string $url, array $headers = [], array $params = [], $multipart = false, $contentType = 'form-data')
    {
        Log::info('call AdServer' . $url, ['params' => $params]);
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
                'data' => $data,
                'extraData' => $response,
                'responseBody' => $response->getBody(),
                'responseHeaders' => $response->getHeaders(),
                'detailRequest' => [
                    'url' => $url,
                    'params' => $params
                ]
            ];
        }catch (\Exception $e)
        {
            Log::error('error request' . $e->getMessage() ?? 'Request api error');
            return [
                'success' => false,
                'message' => $e->getMessage() ?? 'Request api error'
            ];
        }
    }
}
