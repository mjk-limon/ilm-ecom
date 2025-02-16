<?php

use Ilm\Ecom\{Air, Services\ResourceController};

it('can test application', function () {
    // Air::$defaultResponseProvider = function ($r, $rc) {
    //     expect($r)->toBe('errors/403');
    //     return $rc;
    // };

    $controller = new class(new Air) extends ResourceController
    {
        public function moduleName(): ?string
        {
            return 'accounts/opening-balances';
        }

        public function responseProvider(): ?\Closure
        {
            return function ($r, $rc) {
                expect($r)->toBe('accounts/opening-balances/index');
                return $rc;
            };
        }
    };


    $response = $controller->index();
    $new_cached = cache('87d3cf2fcda098612f21cfc9a4756d4f');

    expect($response)->toBeArray();
    expect($new_cached)->toBeArray();
});
