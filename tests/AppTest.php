<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Ilm\Ecom\Air;

it('can test application', function () {
    Config::set('ilm-ecom.client-id', '9e0130f8-d191-43c6-83f1-254929d10ddb');
    Config::set('ilm-ecom.client-secret', 't3RO6zhMf5yEZHxCFJirNGEkAlRjHAZAiIlDt02D');
    Cache::set('ilm_access_token', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5ZTAxMzBmOC1kMTkxLTQzYzYtODNmMS0yNTQ5MjlkMTBkZGIiLCJqdGkiOiI2NWMxMGQxNTE0Mzk3NDBmYTQ2NDJlYmQ4NmQ1NDAzNzk3NmRjZDkwN2U5Nzk1NDhiYTNhZTgzYWY1ZGVkNjBkMGE0YjQ3YWJlNGYzZjBhYSIsImlhdCI6MTczODgyOTUwMy4wNjQyMjUsIm5iZiI6MTczODgyOTUwMy4wNjQyMywiZXhwIjoxNzcwMzY1NTAzLjA1MjA0Mywic3ViIjoiIiwic2NvcGVzIjpbXX0.k4pWu34eLQpz79pRKzg1rlyT_SldIX7OECUwJCTzNJ5X79wKKLEkJ5-TYFLkSwgVmAaUVPkTmgluhJpx8ZH9zB5ZuhE4wNPhgTJERQC9jCoM3mbNYN4w0nqiJ6Y_xVssQSw0Ftcj4F6_pXR_FtA0tnC4WxY3NT3jtLMKsVlqbRHfLeRc0KuMWsVP0uuYK73_v7ofw5uHQgbE0q3SruJ7pOvbGTJtYViuGqX08Ll1aIu8EiO4h9fuR9X_m9_qQTBous64fNh9NXTej2g25fTAeZvgmafPhaaCCX2mefBsKxaPyiT3rWGkqShWl5QhuUVvGYQTBtsXbvThcmrEfuFVxXOevmtmRJRL2a_gyQWtHVr_LXdYkyVP9G2ejp-j28PHfN9mJVowcdd873ohEEc1UiLuQAjiYcy8Ew4OwsoX9MAcVsMh2fz5xiVZOjfULDKNShwmvvXV6VrshX5deJ4vNt9X-luSS0WEwmP8AkI5PkxBttVN4mC5iq_s6OQxqfZdHwfW6Bc2eiq1rH3x7icwxv4fgDgs2eerwwho6TKOJA4j-ES7QiLtbpmMnONxXFic4AVgsZhbngp4broNdrKJCQE8TFRyc0eh76ni2k_s1OkmiOjbmzRcxy64fFZSopGABwUy3NGrV93xwLpFTIVLTAU0bnUZztl6-IPJmcBFdcA');

    $app = new Air;
    $app->setModuleName('accounts');
    $response = $app->get('/opening-balances')->body();

    expect($response)->toBeJson();
});
