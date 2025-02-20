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

        return $this->app->response('index', $response);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function form(?string $id = null)
    {
        try {
            $response = $this->app->get(
                $id ? $id . '/edit' : 'create'
            );
        } catch (\Exception $e) {
            return $this->app->error($e);
        }

        return $this->app->response('form', $response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function upsert(Request $request, ?string $id = null)
    {
        try {
            $data = $request->all();

            $response = $id !== null
                ? $this->app->put($id, $data)
                : $this->app->post('/', $data);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors($e);
        }

        return redirect()->back()
            ->with('success', $response);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $response = $this->app->get('/show/' . $id);
        } catch (\Exception $e) {
            return $this->app->error($e);
        }

        return $this->app->response('show', $response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $response = $this->app->delete($id);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors($e);
        }

        return redirect()->back()
            ->with('success', $response);
    }
}
