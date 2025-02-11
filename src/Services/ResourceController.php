<?php

namespace Ilm\Ecom\Services;

use Illuminate\Http\Request;

abstract class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $response = $this->app->get('/');
        } catch (\Exception $e) {
            return $this->app->error($e);
        }

        return $this->app->response('index', '[]', $this->responseOptions());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function form()
    {
        return $this->app->response('form', '[]', $this->responseOptions());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function upsert(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Default Response files
     *
     * @return array|null
     */
    protected function responseOptions(): ?array
    {
        $module = $this->moduleName();

        return [
            'module' => $module,
            'defaults' => [
                'index' => 'index',
                'form' => 'form',
            ],
            'customs' => [],
        ];
    }
}
