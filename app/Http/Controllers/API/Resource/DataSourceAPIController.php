<?php

namespace App\Http\Controllers\API\Resource;

use App\DataSource;
use App\Http\Requests\StoreDataSource;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Zend\Diactoros\ResponseFactory;

class DataSourceAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function index()
    {
        // paginate the resource
        $result = DataSource::where('user_id', auth()->user()->id)
            ->offset(request('offset'))
            ->paginate(request('limit'));

        return response($result->items(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|StoreDataSource $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function store(StoreDataSource $request)
    {
        $data = array_merge(
            $request->all(),
            ['user_id' => auth()->user()->id]
        );
        $dataSource = DataSource::create($data);

        return response($dataSource, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param DataSource $dataSource
     * @param StoreDataSource $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function show(DataSource $dataSource)
    {
        return response($dataSource, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request|StoreDataSource $request
     * @param DataSource $dataSource
     * @return Response
     */
    public function update(StoreDataSource $request, DataSource $dataSource)
    {
        $dataSource->update($request->all());
        return response($dataSource, Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DataSource $dataSource
     * @return Response
     * @throws Exception
     */
    public function destroy(DataSource $dataSource)
    {
        $dataSource->delete();
        return response("OK", Response::HTTP_ACCEPTED);
    }
}
