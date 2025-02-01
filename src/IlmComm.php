<?php

namespace Ilm\Ecom;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Ilm\Ecom\Exceptions\GeneralException;

abstract class IlmComm
{
    protected $http;

    abstract public function get(string $path);

    public function __construct()
    {
        $this->http = Http::asMultipart();

        if (config('ilm-ecom.sandbox')) {
            $this->http->withoutVerifying();
            $this->http->baseUrl(config('ilm-ecom.sandbox-url'));
        } else {
            $this->http->baseUrl(config('ilm-ecom.url'));
        }

        if ($accessToken = Cache::get('ilm_access_token')) {
            $this->http->withToken($accessToken);
            return;
        }

        $this->attemptLogin();
    }

    public function attemptLogin()
    {
        $clientId = config('ilm-ecom.client-id');
        $clientSecret = config('ilm-ecom.client-secret');

        if (!$clientId || !$clientSecret) {
            throw GeneralException::make(GeneralException::CLIENT_NOT_FOUND);
        }

        $payload = [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ];

        $request = $this->http->post('/oauth/token', $payload);

        if ($request->status() === 200) {
            $response = $request->body();

            if ($accessToken = $response['accessToken'] ?? null) {
                $this->http->withToken($accessToken);
                return true;
            }

            throw GeneralException::make(GeneralException::CLIENT_CREDENTIALS_ERROR);
        }

        throw GeneralException::make(GeneralException::HTTP_REQUEST_ERROR);
    }
}
