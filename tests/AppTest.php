<?php

use Illuminate\Support\Facades\{Cache, Config};
use Ilm\Ecom\{Air, Services\ResourceController};

it('can test application', function () {
    Config::set('ilm-ecom.sandbox-url', 'https://creative.jahidlimon.com/ilm-ecom');
    Config::set('ilm-ecom.client-id', '9e255dee-2bbb-4e29-aed4-70e365426c2a');
    Config::set('ilm-ecom.client-secret', 'jr0aDtt9JW4ZxeYJqMTs1R134NxjIvuL4VHm7fsG');

    Air::$defaultResponseProvider = function ($r, $rc) {
        return $rc;
    };

    $controller = new class(new Air) extends ResourceController
    {
        public function moduleName(): ?string
        {
            return 'accounts/opening-balances';
        }
    };


    $response = $controller->index();
    expect($response)->toBeJson();
});
