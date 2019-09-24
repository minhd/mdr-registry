<?php

namespace App\Http\Controllers\API\Resource;

use App\Registry\Models\Record;
use App\Registry\Models\Version;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class RecordVersionAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Record $record
     * @return void
     */
    public function index(Record $record)
    {
        return response($record->versions, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Record $record
     * @return void
     */
    public function store(Request $request, Record $record)
    {
        $version = Record::create($request->all());

        return response($version, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record, Version $version)
    {
        return response($version, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Version $version
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Version $version)
    {
        $version->update($request->all());

        return response($version, Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Version $version)
    {
        $version->delete();

        return response("OK", Response::HTTP_ACCEPTED);
    }
}
