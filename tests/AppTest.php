<?php

use Illuminate\Support\Facades\Route;
use Ilm\Ecom\{Air, Services\ResourceController};

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
            return $rc;
        };
    }
};

it('can test resource index', function () use ($controller) {
    /** @var \Orchestra\Testbench\TestCase $this */
    Route::resourceModule('a-ob', $controller::class);

    $response = $this->get('a-ob');
    $response->assertOk();
    $response->assertJsonStructure();

    $new_cached = cache('87d3cf2fcda098612f21cfc9a4756d4f');
    expect($new_cached)->toBeArray();
});

it('can test resource form', function () use ($controller) {
    /** @var \Orchestra\Testbench\TestCase $this */
    Route::resourceModule('a-ob', $controller::class);

    $response = $this->get('a-ob/form/abcd-abcd-abcd');
    $response->assertOk();
    $response->assertJsonStructure();

    $new_cached = cache('4d8d443834df003f8a2ff50c0161a794');
    expect($new_cached)->toBeArray();
});

// it('can test resource upsert', function () use ($controller) {
//     /** @var \Orchestra\Testbench\TestCase $this */
//     Route::resourceModule('a-ob', $controller::class);

//     $response = $this->post('a-ob', [
//         'financial_year_id' => 1,
//         'date' => date('Y-m-d'),
//         'coa_id' => 1,
//     ]);
//     $response->assertRedirect();
//     $response->assertSessionHas('success');
// });
