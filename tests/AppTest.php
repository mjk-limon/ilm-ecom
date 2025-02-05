<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Ilm\Ecom\Air;

it('can test', function () {
    Config::set('ilm-ecom.client-id', '9e0130f8-d191-43c6-83f1-254929d10ddb');
    Config::set('ilm-ecom.client-secret', 't3RO6zhMf5yEZHxCFJirNGEkAlRjHAZAiIlDt02D');
    // Cache::set('ilm_access_token', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5ZTAxMzBmOC1kMTkxLTQzYzYtODNmMS0yNTQ5MjlkMTBkZGIiLCJqdGkiOiIyMjA3ZmZhOWU2NzYzM2Y5OTkxZjRiM2MzYjU0NjYwOGM3ZTU3MTgwZDllMWUxNjE1YjgxZDllZGJhYmVmYTA4YjQ5OGE1ZjQ0MTIxNDI0YSIsImlhdCI6MTczODczODQyNS44MjIyODksIm5iZiI6MTczODczODQyNS44MjIyOTUsImV4cCI6MTc3MDI3NDQyNS44MDgyNDYsInN1YiI6IiIsInNjb3BlcyI6W119.how2MjqBb63MJBBTZShBCZTwTV0sSaWfHHevyC1XOF5Q_LV6kC4Ru-HdPxUmq3EqIEKq-PU5mVTQh6HHLinaLSzBklDS_IQAjqIfRcoKQdEutINgfrdi1fuP4k4s01L1e_w568sOPj34x1cF11xMEDNSyXMi9asWkgwrPeA1xty8nTfh_eW4371AIdnnTTBZvFNK6mVnSx8aoQ5LZ6NbszlUdpeMZyK4F2c0MZ9JHbrCrbJs86LZg6eKYigLn7k5ih1O57cXvqzvdI9Doby8IPgJb8PUbaG5J8TlneF_phA5aZlpyJZh1E4Ya9RzCYcxH75sTX2kZ3WOwZwu6pcMm2YjMGXcJoiy03XLJhLlGlm_HviFjLhgEBOcBkcLxFGBfi2g6c7FQyIbBJNto8bEFrERVH4FzObnMUU9G1P5JDg4GZEueTVj-t8r_JJmU3KU7Pj-ffe8xdYgrWVGw_aMVka9424l5vACra5lrCXSZL8X7AvG1FCnvd5AnmgowWhdpSESdrpJgNQmoyU1ZvMsPfsSv20ydZNdlzCiSMO6Hlbygd2PCwzgZle3RuOrsAy7wlrM1tZ9rmoNFbvwMjaFxZbFd_f3UgxRErlY1NvlsOCkYXvQ1V3f7d3Mbmj8u-AyV8U5mKtV-Q3MMQy5_I_ce1qI1FxQz9MqpfHVnYzu4L');

    $app = new Air;
    $response = $app->get('/api/accounts/opening-balances')->body();

    expect($response)->toBeJson();
});
