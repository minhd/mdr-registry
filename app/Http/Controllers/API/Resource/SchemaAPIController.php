<?php

namespace App\Http\Controllers\API\Resource;

use App\Schema;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class SchemaAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = (new Schema)
            ->offset(request('offset'))
            ->paginate(request('limit'));

        return response($result->items(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $schema = Schema::create($request->all());

        // add a version?
        return response($schema, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Schema $schema)
    {
        return response($schema, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schema $schema)
    {
        $schema->update($request->all());
        return response($schema, Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $i
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schema $schema)
    {
        $schema->delete();
        return response("OK", Response::HTTP_ACCEPTED);
    }
}
