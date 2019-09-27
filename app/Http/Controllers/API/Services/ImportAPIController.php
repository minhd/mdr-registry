<?php


namespace App\Http\Controllers\API\Services;


use App\Http\Controllers\Controller;
use App\Registry\ImportManager;
use App\Registry\Models\DataSource;
use Illuminate\Http\Request;

class ImportAPIController extends Controller
{
    public function store(Request $request)
    {
        // TODO authentication check
        // $dataSourceID = $request->input('data_source_id');

        // TODO check datasource existence
        // $dataSource = DataSource::find($dataSourceID);

        $manager = new ImportManager();

        // TODO sanitize request
        $manager->import($request->all());
    }
}
