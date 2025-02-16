<?php

namespace Ilm\Ecom;

use Illuminate\Support\Facades\Http;
use Ilm\Ecom\Exceptions\GeneralException;

abstract class IlmComm
{
    /**
     * @var \Illuminate\Http\Client\PendingRequest
     */
    private $http;

    /**
     * @var \Illuminate\Cache\CacheManager|\Illuminate\Contracts\Cache\Repository
     */
    private $cache;

    protected $httpBaseUrl;

    protected function cache()
    {
        if (! $this->cache) {
            $this->cache = app('cache');
        }

        return $this->cache;
    }

    protected function cacheKey(string $path, $query)
    {
        $queryString = $query && ! is_string($query) ? http_build_query($query) : strval($query);
        $key = sprintf('%s_%s', $path, $queryString);
        return md5($key);
    }

    protected function http()
    {
        if (! $this->http) {
            $this->http = Http::asMultipart();

            if (config('ilm-ecom.sandbox')) {
                $this->http->withoutVerifying();

                $this->http->baseUrl(
                    $this->httpBaseUrl = config('ilm-ecom.sandbox-url')
                );
            } else {
                $this->http->baseUrl(
                    $this->httpBaseUrl = config('ilm-ecom.url')
                );
            }
        }

        return $this->http;
    }

    protected function authorizedHttp()
    {
        $http = clone $this->http();

        if ($accessToken = $this->cache()->get('ilm_access_token')) {
            $http->withToken($accessToken);
        } else {
            $this->attemptLogin($http);
        }

        return $http;
    }

    private function attemptLogin($http)
    {
        $clientId = config('ilm-ecom.client-id');
        $clientSecret = config('ilm-ecom.client-secret');

        if (! $clientId || ! $clientSecret) {
            throw GeneralException::make(GeneralException::CLIENT_NOT_FOUND);
        }

        $payload = [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ];

        $request = $http->post('/oauth/token', $payload);

        if ($request->status() === 200) {
            $response = $request->json();

            if ($accessToken = $response['access_token'] ?? null) {
                $http->withToken($accessToken);
                $this->cache()->set('ilm_access_token', $accessToken, $response['expires_in']);

                return $accessToken;
            }

            throw GeneralException::make(GeneralException::CLIENT_CREDENTIALS_ERROR);
        }

        throw GeneralException::make(GeneralException::HTTP_REQUEST_ERROR);
    }
}
