<?php

namespace App\Http\Controllers\API\Resource;

use App\Record;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class RecordAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $result = (new Record)
            ->offset(request('offset'))
            ->paginate(request('limit'));

        return response($result->items(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $record = Record::create($request->all());

        // add a version?
        return response($record, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Record $record)
    {
        return response($record, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, Record $record)
    {
        $record->update($request->all());
        return response($record, Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Record $record)
    {
        $record->delete();
        return response("OK", Response::HTTP_ACCEPTED);
    }
}
