<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Ilm\Ecom\Air;

it('can test application', function () {
    Config::set('ilm-ecom.sandbox-url', 'https://creative.jahidlimon.com/ilm-ecom');
    Config::set('ilm-ecom.client-id', '9e255dee-2bbb-4e29-aed4-70e365426c2a');
    Config::set('ilm-ecom.client-secret', 'jr0aDtt9JW4ZxeYJqMTs1R134NxjIvuL4VHm7fsG');
    Cache::set('ilm_access_token', "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5ZTI1NWRlZS0yYmJiLTRlMjktYWVkNC03MGUzNjU0MjZjMmEiLCJqdGkiOiIxOWIxYzJhMTQyMzRlNTBjN2NmOWZlN2Y4ZGYzZDhmNmM1ZTBmZjdhYzI0ZjY1NjE0OTNhMjdkMWMxY2Q2MDhlODA2ZmE0YmRlM2VkMTNiNyIsImlhdCI6MTczODgzMzYyMS4wODU0NzksIm5iZiI6MTczODgzMzYyMS4wODU0ODEsImV4cCI6MTc3MDM2OTYyMS4wODM3MjMsInN1YiI6IiIsInNjb3BlcyI6W119.mOzThiECX0u666hgKyOu-qC_Uu1skOXfLlBqfX8PbMIhiurulXIwKEGO_kvIQptwNqVyn-RF9_enz8IQ9XwSofpiPs0WE6EayIAbza6sUCYCy1p22ChzzoR6tMsJYTHDUJ83v0d-OHty-XVj7I8IyIu_beAXipVJONfe7K99m9Vl3TgHqE3zd7jdMLXAq4NdcSNLrAduOTAYSDZC-Z1isd4_Kh2GsFGjAceGjQJU7V-IwqzdkKv0b_F6EMmcVpbDOhr_n4dUfAiF4vZ-ejrARMy-Nc7s0YzRLz0i74xEnVyyvEAcV9DG7oLOp2TiuzHQk9zMwAT6P3kdJsiM_hIlkdYylbAcD0XTgg0SiCy1p7A9xOHhSjw342zfNwKAF-jjgkqe0YuKvNw7YqyKjYACUHg7XfBiQZapGb77NIAy5YOyg9lS89d93Qm7-cGeXZYv85Mg6c148BVN8kn9c5TC5TemHA8CZzFOsG82txurmUeC2pEKE-i7Rv5_XS2xx7_s6bUuGJ2dT6uvqjSVrYdwSPNhy64-ivpCO5feCKaK2pgb9wfByCt34jxR-97VwSsogwIV0QeZUJquPYdHtMvTYlPOrtOdP1GPTamwemSBnXxs8KnleoDtNcYX6tg1erfpF8Sbr-uKV7NqMFQrFY1VdYZm-WMxIg260sRj4-T9fMA");

    $app = new Air;
    $app->setModuleName('accounts');
    $response = $app->get('/opening-balances')->body();

    expect($response)->toBeJson();
});
