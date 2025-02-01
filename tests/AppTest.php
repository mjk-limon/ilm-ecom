<?php

use Ilm\Ecom\Air;

it('can test', function () {
    $test = new Air;
    $test->get('/path');
    expect(true)->toBeTrue();
});
